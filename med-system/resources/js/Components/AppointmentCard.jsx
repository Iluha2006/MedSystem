import StatusBadge from './StatusBadge';
import InfoButton from './InfoButton';
import SuccessButton from './SuccessButton';
import DangerButton from './DangerButton';

export default function AppointmentCard({
    appointment,
    onEdit,
    onComplete,
    onCancel,
}) {
    const isFinished =
        appointment.status === 'completed' || appointment.status === 'cancelled';

    return (
        <div className="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
            <div className="flex flex-wrap justify-between items-start">
                <div className="flex-1">
                    <div className="flex items-center gap-2 mb-2">
                        <h3 className="text-lg font-semibold text-gray-900">
                            {appointment.patient_name}
                        </h3>
                        <StatusBadge status={appointment.status} />
                    </div>
                    <p className="text-gray-600 mb-1">
                        <span className="font-medium">Жалобы:</span>{' '}
                        {appointment.complaint || 'Не указаны'}
                    </p>
                    <p className="text-gray-600 mb-1">
                        <span className="font-medium">Дата:</span>{' '}
                        {appointment.visit_date_formatted ||
                            new Date(appointment.visit_date).toLocaleString('ru-RU')}
                    </p>
                    {appointment.diagnosis && (
                        <p className="text-gray-600 mb-1">
                            <span className="font-medium">Диагноз:</span>{' '}
                            {appointment.diagnosis}
                        </p>
                    )}
                    {appointment.prescription && (
                        <p className="text-gray-600 mb-1">
                            <span className="font-medium">Назначение:</span>{' '}
                            {appointment.prescription}
                        </p>
                    )}
                    {appointment.cabinet && (
                        <p className="text-gray-600">
                            <span className="font-medium">Кабинет:</span>{' '}
                            {appointment.cabinet}
                        </p>
                    )}
                </div>

                <div className="flex gap-2 mt-4 md:mt-0">
                    <InfoButton onClick={() => onEdit(appointment)}>
                        Обработать
                    </InfoButton>
                    
                    {!isFinished && (
                        <DangerButton onClick={() => onCancel(appointment.id)}>
                            Отменить
                        </DangerButton>
                    )}
                </div>
            </div>
        </div>
    );
}
