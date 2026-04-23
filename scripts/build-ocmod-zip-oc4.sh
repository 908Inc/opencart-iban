#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="${ROOT_DIR}/src/oc4"

ZIP_PATH="${ROOT_DIR}/iban_opencart-4.ocmod.zip"

if [ ! -f "${SRC_DIR}/install.json" ]; then
  echo "ERROR: Missing ${SRC_DIR}/install.json"
  exit 1
fi

rm -f "${ZIP_PATH}"

echo "Building ${ZIP_PATH} (OpenCart 4.x) ..."
(cd "${SRC_DIR}" && zip -r "${ZIP_PATH}" admin catalog install.json -x "*.DS_Store" "*/.DS_Store")

echo "Done."
