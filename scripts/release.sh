#!/usr/bin/env bash
set -euo pipefail

# Usage: scripts/release.sh <patch|minor|major> [--yes]
#
# Bumps VERSION per SemVer, rebuilds the three OCMOD zips, commits,
# tags, and (after confirmation) pushes + creates a GitHub Release.
# Must be run from a clean working tree on 'main'.
# Pass --yes / -y to skip the confirmation prompt before push + release.

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

BUMP="${1:-}"
shift || true
AUTO_YES="false"
for arg in "$@"; do
  case "$arg" in
    --yes|-y) AUTO_YES="true" ;;
  esac
done

case "$BUMP" in
  patch|minor|major) ;;
  *)
    echo "Usage: $0 <patch|minor|major> [--yes]" >&2
    exit 1
    ;;
esac

if [ -n "$(git status --porcelain)" ]; then
  echo "ERROR: working tree not clean. Commit or stash changes first." >&2
  exit 1
fi

CURRENT_BRANCH="$(git rev-parse --abbrev-ref HEAD)"
if [ "$CURRENT_BRANCH" != "main" ]; then
  echo "ERROR: releases must be cut from 'main' (currently on '$CURRENT_BRANCH')." >&2
  exit 1
fi

CURRENT="$(tr -d '[:space:]' < VERSION)"
IFS='.' read -r MAJ MIN PAT <<< "$CURRENT"

case "$BUMP" in
  patch) PAT=$((PAT + 1)) ;;
  minor) MIN=$((MIN + 1)); PAT=0 ;;
  major) MAJ=$((MAJ + 1)); MIN=0; PAT=0 ;;
esac

NEW="${MAJ}.${MIN}.${PAT}"
TAG="v${NEW}"

if git rev-parse "$TAG" >/dev/null 2>&1; then
  echo "ERROR: tag $TAG already exists." >&2
  exit 1
fi

echo "Bumping ${CURRENT} → ${NEW}"
echo "$NEW" > VERSION

bash scripts/build-ocmod-zip-oc2_3.sh
bash scripts/build-ocmod-zip-oc3.sh
bash scripts/build-ocmod-zip-oc4.sh

git add VERSION \
  iban_opencart-2_3.ocmod.zip \
  iban_opencart-3.ocmod.zip \
  iban_opencart-4.ocmod.zip
git commit -m "Release ${TAG}"
git tag "$TAG"

echo ""
echo "Committed and tagged ${TAG} locally."

if [ "$AUTO_YES" != "true" ]; then
  read -r -p "Push to origin and create GitHub Release? [y/N] " REPLY
  case "$REPLY" in
    y|Y|yes|YES) ;;
    *)
      echo "Stopped before push. Run manually when ready:"
      echo "  git push origin main $TAG"
      echo "  gh release create $TAG iban_opencart-*.ocmod.zip --title $TAG --generate-notes"
      exit 0
      ;;
  esac
fi

git push origin main "$TAG"
gh release create "$TAG" \
  iban_opencart-2_3.ocmod.zip \
  iban_opencart-3.ocmod.zip \
  iban_opencart-4.ocmod.zip \
  --title "$TAG" \
  --generate-notes

echo ""
echo "Released ${TAG}."
