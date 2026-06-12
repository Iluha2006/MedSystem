# Design System

## Buttons

### PrimaryButton
- Dark background (`bg-gray-800`), white text
- Uppercase, small font, tracking-wider
- For main actions (Save, Submit)

### SecondaryButton
- White background, gray border (`border-gray-300`)
- Gray text, shadow-sm
- For secondary actions (Cancel, Back)

### InfoButton
- Blue background (`bg-blue-600`), white text
- For edit/process actions (Обработать)

### SuccessButton
- Green background (`bg-green-600`), white text
- For completion actions (Завершить)

### DangerButton
- Red background (`bg-red-600`), white text
- For destructive actions (Отменить, Удалить)

## Badges

### StatusBadge
- `scheduled` (Запланирован) - `bg-blue-100 text-blue-800`
- `confirmed` (Подтвержден) - `bg-green-100 text-green-800`
- `completed` (Завершен) - `bg-gray-100 text-gray-800`
- `cancelled` (Отменен) - `bg-red-100 text-red-800`

## Cards

### AppointmentCard
- White background, rounded-xl, shadow
- Hover: shadow-lg transition
- Contains patient info, date, complaint, diagnosis, cabinet
- Action buttons on the right

## Modal

### AppointmentModal
- Uses existing Modal component from Headless UI
- Form with status select, cabinet select, complaint textarea, diagnosis textarea
- Save/Cancel buttons at the bottom

## Layout

### Colors
- Page background: `bg-gray-50`
- Cards: `bg-white`
- Primary text: `text-gray-900`
- Secondary text: `text-gray-600`
- Links/actions: `text-blue-600`

### Spacing
- Page padding: `py-12`
- Container: `max-w-7xl mx-auto px-4 sm:px-6 lg:px-8`
- Card padding: `p-6`
- Grid gap: `gap-4`

### Typography
- Page title: `text-2xl font-bold`
- Card title: `text-lg font-semibold`
- Labels: `text-sm font-medium`
- Body: `text-base`
