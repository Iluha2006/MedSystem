# Информационная система «Медицинские организации»

## Описание предметной области

Информационная система предназначена для автоматизации деятельности медицинских организаций — больниц, поликлиник и других учреждений здравоохранения. Система обеспечивает ведение учёта пациентов, врачей, стационарных и амбулаторных приёмов, операций, лабораторных исследований, а также управление ресурсами (здания, отделения, палаты, койки, кабинеты).

### Основные функции

- Регистрация и управление пациентами
- Учёт врачей с указанием специальности, степени, звания
- Ведение амбулаторных приёмов и стационарных госпитализаций
- Учёт и планирование операций
- Управление лабораториями и договорами на лабораторные исследования
- Управление инфраструктурой: здания, отделения, палаты, койки, кабинеты
- Ролевая модель: администратор, врач, пациент

---

## Модели предметной области

### 1. **Facility** (Медицинское учреждение)
- Центральная сущность, представляющая больницу, поликлинику или другое медучреждение.
- Атрибуты: `name`, `type`, `address`.
- Поддерживает иерархию: учреждение может иметь родительское учреждение (`parent_hospital_id`).
- Связано с: `Building`, `Department`, `Doctor` (через `DoctorFacility`), `LaboratoryContract`.

### 2. **Building** (Здание)
- Здание, принадлежащее медицинскому учреждению.
- Атрибуты: `name`, `facility_id`.
- Связано с: `Facility`, `Department`, `Cabinet`.

### 3. **Department** (Отделение)
- Структурное подразделение в здании/учреждении.
- Атрибуты: `name`, `specialization`, `building_id`, `facility_id`.
- Связано с: `Building`, `Facility`, `Ward`.

### 4. **Cabinet** (Кабинет)
- Помещение для амбулаторного приёма.
- Атрибуты: `facility_id`, `building_id`, `cabinet_number`, `name`, `is_active`.
- Связано с: `Facility`, `Building`, `OutpatientVisit`.

### 5. **Ward** (Палата)
- Палата в отделении стационара.
- Атрибуты: `department_id`, `ward_number`, `capacity`.
- Связано с: `Department`, `Bed`.

### 6. **Bed** (Койка)
- Койка в палате.
- Атрибуты: `ward_id`, `bed_number`, `is_occupied`.
- Связано с: `Ward`, `InpatientStay`.

### 7. **Doctor** (Врач)
- Медицинский сотрудник — врач.
- Атрибуты: `user_id`, `name`, `specialty_id`, `degree_id`, `academic_title_id`, `experience_years`, `hazard_coeff`.
- Связано с: `User`, `Specialty`, `Degree`, `AcademicTitle`, `Facility` (через `DoctorFacility`), `InpatientStay`, `OutpatientVisit`, `Operation`.

### 8. **Specialty** (Специальность)
- Врачебная специальность.
- Атрибуты: `name`, `can_perform_operations`, `has_hazard_pay`, `extended_vacation_days`.
- Связано с: `Doctor`.

### 9. **Degree** (Учёная степень)
- Учёная степень врача (например, кандидат наук, доктор наук).
- Атрибуты: `name`.
- Связано с: `Doctor`.

### 10. **AcademicTitle** (Учёное звание)
- Атрибуты: `name`, `required_degree_id`.
- Связано с: `Degree`, `Doctor`.

### 11. **DoctorFacility** (Связь врач-учреждение)
- Пивот-таблица many-to-many с дополнительными атрибутами.
- Атрибуты: `doctor_id`, `facility_id`, `is_main_job` (основное место работы), `role`.

### 12. **Patient** (Пациент)
- Зарегистрированный пациент.
- Атрибуты: `user_id`, `name`, `age`, `birth_date`, `phone`, `medical_history`.
- Связано с: `User`, `InpatientStay`, `OutpatientVisit`, `Operation`.

### 13. **InpatientStay** (Госпитализация / пребывание в стационаре)
- Запись о пребывании пациента в стационаре.
- Атрибуты: `patient_id`, `bed_id`, `attending_doctor_id`, `admission_date`, `discharge_date`, `condition`, `temperature`.
- Вычисляемый атрибут: `is_active` — `true`, если `discharge_date === null`.

### 14. **OutpatientVisit** (Амбулаторный приём)
- Запись о приёме врача в поликлинике.
- Атрибуты: `patient_id`, `doctor_id`, `facility_id`, `assigned_cabinet_id`, `visit_date`, `complaint`, `diagnosis`, `prescription`, `status` (scheduled/confirmed/cancelled/completed).

### 15. **Operation** (Операция)
- Хирургическое вмешательство.
- Атрибуты: `patient_id`, `doctor_id`, `facility_id`, `operation_date`, `name`, `operation_type`, `diagnosis`, `description`, `result`, `is_fatal`, `complications`.

### 16. **Laboratory** (Лаборатория)
- Внешняя или внутренняя лаборатория.
- Атрибуты: `name`, `profile`.
- Связано с: `LaboratoryContract`.

### 17. **LaboratoryContract** (Договор с лабораторией)
- Договор между учреждением и лабораторией.
- Атрибуты: `laboratory_id`, `facility_id`, `start_date`, `end_date`.

### 18. **MedicalStaff** (Медицинский персонал)
- Общая запись о сотруднике (не враче).
- Атрибуты: `first_name`, `last_name`, `middle_name`, `position`, `facility_id`.

### 19. **User** (Пользователь)
- Учётная запись для входа в систему.
- Атрибуты: `name`, `email`, `password`.
- Роли: `admin`, `doctor`, `patient` (через Spatie Permission).
- Может иметь связанного `Doctor` или `Patient`.

---

## Схема связей (кратко)

```
Facility ──┬── Building ── Department ── Ward ── Bed ── InpatientStay
           │                                              │
           ├── Cabinet ──── OutpatientVisit ──────────────┤
           │                              │               │
           ├── DoctorFacility ── Doctor ──┤               └── Patient
           │                    │         └── Operation
           ├── LaboratoryContract ── Laboratory
           │
           └── MedicalStaff
```

---

## Ролевая модель и полномочия

Система реализует три роли на базе **Spatie Laravel Permission**. Доступ к ресурсам разграничен через **политики** (Policies) и **разрешения** (Permissions).

### 1. **Администратор** (`admin`)

Имеет полный доступ ко всем функциям системы.

**Filament admin-панель (`/admin`):**
- Управление учреждениями (Facility), зданиями (Building), отделениями (Department)
- Управление врачами, пациентами, кабинетами
- Управление палатами (Ward) и койками (Bed)
- Управление лабораториями и договорами
- Просмотр статистики (StatsOverview)
- Управление пользователями и ролями

**Frontend:**
- Просмотр, создание, редактирование и удаление любых записей на приём
- Просмотр и управление всеми врачами и пациентами
- Подтверждение/отмена любых записей

**Разрешения:** все (`view users`, `create users`, `edit users`, `delete users`, `view patients`, `create patients`, `edit patients`, `delete patients`, `view appointments`, `create appointments`, `edit appointments`, `delete appointments`, `view medical_records`, `create medical_records`, `edit medical_records`, `view reports`, `create reports`, `export reports`, `view doctors`, `create doctors`, `edit doctors`, `delete doctors`).

---

### 2. **Врач** (`doctor`)

Работает через **Frontend** (Inertia/React) со своим рабочим кабинетом.

**Возможности:**
- Просматривать список пациентов
- Просматривать и управлять своими записями на приём (appointments)
- Изменять статус записи: подтвердить (`confirm`), завершить приём (`complete`), отменить (`cancel`)
- Заполнять жалобу (`complaint`), диагноз (`diagnosis`) и назначение (`prescription`) по итогам приёма
- Назначать кабинет для приёма
- Создавать записи на приём для пациентов
- Просматривать медицинские карты пациентов
- Просматривать список врачей
- Просматривать отчёты

**Ограничения:**
- Редактирует только **свои** записи на приём
- Не может создавать/редактировать/удалять других врачей
- Не имеет доступа к Filament admin-панели (только администратор)
- Не может удалять пациентов

**Разрешения:** `view patients`, `view appointments`, `create appointments`, `edit appointments`, `view medical_records`, `create medical_records`, `view doctors`, `view reports`.

---

### 3. **Пациент** (`patient`)

Работает через **Frontend** (Inertia/React).

**Возможности:**
- Просматривать свои записи на приём
- Создавать новую запись к врачу (выбор специалиста, даты)
- Отменять свою запись
- Просматривать свои медицинские записи

**Ограничения:**
- Видит только **свои** записи на приём
- Не может редактировать/подтверждать записи (только отменить)
- Не может просматривать чужих пациентов или врачей (кроме списка для записи)
- Не имеет доступа к Filament admin-панели
- Не может удалять или создавать пациентов (создаётся при регистрации)

**Разрешения:** `view appointments`, `create appointments`, `delete appointments`, `view medical_records`.

---

### Матрица доступа

| Действие | Админ | Врач | Пациент |
|---|---|---|---|
| Управление учреждениями/зданиями/отделениями | ✅ | — | — |
| Управление врачами (CRUD) | ✅ | ❌ (только просмотр) | ❌ |
| Управление пациентами (CRUD) | ✅ | ✅ (кроме удаления) | ❌ (только свой профиль) |
| Просмотр записей на приём | ✅ (все) | ✅ (только свои) | ✅ (только свои) |
| Создание записи на приём | ✅ | ✅ | ✅ |
| Редактирование записи | ✅ | ✅ (только свои) | ❌ |
| Подтверждение записи | ✅ | ✅ (только свои) | ❌ |
| Завершение приёма (диагноз) | ✅ | ✅ (только свои) | ❌ |
| Отмена записи | ✅ | ✅ (только свои) | ✅ (только свои) |
| Доступ к Filament admin (`/admin`) | ✅ | ❌ | ❌ |

---

## Технологический стек

- **Backend:** Laravel 12 (PHP)
- **Admin-панель:** Filament PHP
- **Frontend:** Blade, Tailwind CSS, Vite, Alpine.js
- **База данных:** SQLite (для разработки), поддержка MySQL/PostgreSQL
- **Аутентификация:** Laravel Breeze
- **Роли и права:** Spatie Laravel Permission
- **Архитектура:** Repository + Service + DTO

---

## Структура проекта (app/)

```
app/
├── Console/              # Artisan-команды
├── DTOs/                 # Data Transfer Objects
├── Enums/                # Перечисления (Role)
├── Filament/Admin/       # Ресурсы и виджеты Filament
├── Http/
│   ├── Controllers/      # REST-контроллеры
│   ├── Middleware/        # Промежуточное ПО
│   └── Requests/         # Form Request-валидаторы
├── Models/               # Eloquent-модели (19 шт.)
├── Policies/             # Политики доступа
├── Providers/            # Сервис-провайдеры
├── Repositories/         # Репозитории (слой доступа к данным)
└── Services/             # Сервисы (бизнес-логика)
```
