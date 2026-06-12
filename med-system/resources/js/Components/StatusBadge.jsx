const statusConfig = {
    scheduled: { text: 'Запланирован', color: 'bg-blue-100 text-blue-800' },
    confirmed: { text: 'Подтвержден', color: 'bg-green-100 text-green-800' },
    completed: { text: 'Завершен', color: 'bg-gray-100 text-gray-800' },
    cancelled: { text: 'Отменен', color: 'bg-red-100 text-red-800' },
};

export default function StatusBadge({ status }) {
    const config = statusConfig[status] || statusConfig.scheduled;

    return (
        <span className={`px-2 py-1 rounded-full text-xs font-medium ${config.color}`}>
            {config.text}
        </span>
    );
}
