#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
SRC_DIR="${ROOT_DIR}/src/oc2_3"

ZIP_PATH="${ROOT_DIR}/iban_opencart-2_3.ocmod.zip"

if [ ! -d "${SRC_DIR}/upload" ]; then
  echo "ERROR: Missing ${SRC_DIR}/upload"
  exit 1
fi

rm -f "${ZIP_PATH}"

echo "Building ${ZIP_PATH} ..."
(cd "${SRC_DIR}" && zip -r "${ZIP_PATH}" upload -x "*.DS_Store" "*/.DS_Store")

echo "Done."
