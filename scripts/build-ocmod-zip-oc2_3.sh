#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="${ROOT_DIR}/src/oc2_3"

ZIP_PATH="${ROOT_DIR}/iban_opencart-2_3.ocmod.zip"
VERSION="$(tr -d '[:space:]' < "${ROOT_DIR}/VERSION")"

if [ ! -d "${SRC_DIR}/upload" ]; then
  echo "ERROR: Missing ${SRC_DIR}/upload"
  exit 1
fi
if [ ! -f "${SRC_DIR}/install.xml" ]; then
  echo "ERROR: Missing ${SRC_DIR}/install.xml"
  exit 1
fi

rm -f "${ZIP_PATH}"

BUILD_DIR="$(mktemp -d)"
trap 'rm -rf "${BUILD_DIR}"' EXIT

cp -R "${SRC_DIR}/upload" "${BUILD_DIR}/upload"
sed "s/@VERSION@/${VERSION}/g" "${SRC_DIR}/install.xml" > "${BUILD_DIR}/install.xml"

echo "Building ${ZIP_PATH} (version ${VERSION}) ..."
(cd "${BUILD_DIR}" && zip -r "${ZIP_PATH}" install.xml upload -x "*.DS_Store" "*/.DS_Store")

echo "Done."
