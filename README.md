# Opendatabot IBAN Invoice для OpenCart

Модуль оплати: створює рахунок IBAN через Opendatabot і перенаправляє покупця на сторінку оплати. Опційно — автоматичне підтвердження через Автоклієнт Opendatabot (callback).

**Підтримка:** OpenCart 4.x (PHP 8.1+), 3.x (PHP 7.4+), 2.3.x (PHP 7.0+). Валюта — лише **UAH**.

---

## Що потрібно

- Архів відповідної версії: `iban_opencart-4.ocmod.zip`, `iban_opencart-3.ocmod.zip` або `iban_opencart-2_3.ocmod.zip`.
- Ключі API Opendatabot (`x-client-key`, `x-client-name`) — отримати на [iban.opendatabot.ua](https://iban.opendatabot.ua/create-invoice).
- Ваш IBAN (UA + 27 цифр) та РНОКПП/ЄДРПОУ (8 або 10 цифр).

## Встановлення через адмінку

1. **Розширення → Встановлювач** → завантажити `.ocmod.zip`.
2. Для OC 3.x / 2.3.x: **Розширення → Модифікації → Оновити**.
3. **Розширення → Розширення** → тип **Оплата** → знайти **Opendatabot IBAN Invoice** → **Встановити** → **Редагувати** → зберегти налаштування.

Якщо адмін-інсталятор недоступний — розпакуйте архів у корінь магазину (для OC 3/2.3 — вміст `upload/`; для OC 4 — у `extension/opendatabot/opencart_iban/`), далі з кроку 2.

## Налаштування

**Основні:** `IBAN`, `РНОКПП/ЄДРПОУ`, `x-client-key`, `x-client-name`, призначення платежу (плейсхолдер `{order_id}`), початковий статус замовлення (рекоменд. **Pending**), увімкнений статус, порядок сортування.

**Автоклієнт** (опційно): увімкнути автопідтвердження, статус після оплати (рекоменд. **Complete**), скопіювати `Callback URL` у Webhook на iban.opendatabot.ua.

## Поширені проблеми

- **«Немає способів оплати»** — валюта кошика не UAH, модуль вимкнено або не заповнені обов'язкові поля.
- Потрібен PHP `curl` і доступ до `https://iban.opendatabot.ua`.
- Callback Автоклієнта має досягати магазину публічним URL.

---

## Розробка

**Структура:** `src/oc4/`, `src/oc3/upload/`, `src/oc2_3/upload/` — код модуля; `dev/oc{4,3,2_3}/` — Docker-стенди; `scripts/` — збірка.

**Збірка:**

```bash
./scripts/build-ocmod-zip-oc4.sh
./scripts/build-ocmod-zip-oc3.sh
./scripts/build-ocmod-zip-oc2_3.sh
```

**Dev-стенд** (OC 4 на `:8080`, OC 3 на `:8081`, OC 2.3 на `:8083`):

```bash
docker compose --env-file dev/oc4/.env \
  -f dev/oc4/docker-compose.yml \
  -f dev/oc4/docker-compose.dev.yml \
  up -d --build
```

`docker-compose.dev.yml` bind-mount-ить `src/` у контейнер. Щоб протестувати встановлення через адмінку — підніміть стенд **без** `docker-compose.dev.yml`.

Зупинити: `docker compose -f dev/oc4/docker-compose.yml down` (`-v` — скинути БД).

---

[Docs OpenCart](https://opencart.gitbook.io/opencart/developer-guide/extensions) · [Opendatabot IBAN](https://iban.opendatabot.ua/create-invoice)
