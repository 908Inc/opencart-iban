#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="${ROOT_DIR}/src/oc4"

ZIP_PATH="${ROOT_DIR}/iban_opencart-4.ocmod.zip"
VERSION="$(tr -d '[:space:]' < "${ROOT_DIR}/VERSION")"

if [ ! -f "${SRC_DIR}/install.json" ]; then
  echo "ERROR: Missing ${SRC_DIR}/install.json"
  exit 1
fi

rm -f "${ZIP_PATH}"

BUILD_DIR="$(mktemp -d)"
trap 'rm -rf "${BUILD_DIR}"' EXIT

cp -R "${SRC_DIR}/admin" "${BUILD_DIR}/admin"
cp -R "${SRC_DIR}/catalog" "${BUILD_DIR}/catalog"
sed "s/@VERSION@/${VERSION}/g" "${SRC_DIR}/install.json" > "${BUILD_DIR}/install.json"

echo "Building ${ZIP_PATH} (OpenCart 4.x, version ${VERSION}) ..."
(cd "${BUILD_DIR}" && zip -r "${ZIP_PATH}" admin catalog install.json -x "*.DS_Store" "*/.DS_Store")

echo "Done."
