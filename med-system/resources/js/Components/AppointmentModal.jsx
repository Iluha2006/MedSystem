import Modal from '@/Components/Modal';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function AppointmentModal({
    appointment,
    formData,
    cabinets,
    isProcessing,
    onClose,
    onChange,
    onSubmit,
}) {
    if (!appointment) return null;

    return (
        <Modal show={true} onClose={onClose}>
            <div className="p-6">
                <h2 className="text-xl font-bold text-gray-900 mb-4">
                    Обработка записи - {appointment.patient_name}
                </h2>

                <form onSubmit={onSubmit} className="space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Статус
                        </label>
                        <select
                            value={formData.status}
                            onChange={(e) =>
                                onChange({ ...formData, status: e.target.value })
                            }
                            className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="scheduled">Запланирован</option>
                            <option value="confirmed">Подтвержден</option>
                            <option value="completed">Завершен</option>
                            <option value="cancelled">Отменен</option>
                        </select>
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Назначить кабинет
                        </label>
                        <select
                            value={formData.assigned_cabinet_id}
                            onChange={(e) =>
                                onChange({
                                    ...formData,
                                    assigned_cabinet_id: e.target.value,
                                })
                            }
                            className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                        >
                            <option value="">Не назначен</option>
                            {cabinets.map((cabinet) => (
                                <option key={cabinet.id} value={cabinet.id}>
                                    {cabinet.full_name} ({cabinet.facility_name})
                                </option>
                            ))}
                        </select>
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Жалобы пациента
                        </label>
                        <textarea
                            value={formData.complaint}
                            onChange={(e) =>
                                onChange({ ...formData, complaint: e.target.value })
                            }
                            rows="2"
                            className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Что беспокоит пациента..."
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Диагноз
                        </label>
                        <textarea
                            value={formData.diagnosis}
                            onChange={(e) =>
                                onChange({ ...formData, diagnosis: e.target.value })
                            }
                            rows="2"
                            className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Клинический диагноз..."
                        />
                    </div>

                    <div>
                        <label className="block text-sm font-medium text-gray-700 mb-1">
                            Назначение (лекарства, процедуры)
                        </label>
                        <textarea
                            value={formData.prescription}
                            onChange={(e) =>
                                onChange({ ...formData, prescription: e.target.value })
                            }
                            rows="2"
                            className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Назначение врача..."
                        />
                    </div>

                    <div className="flex justify-end gap-3 pt-4">
                        <SecondaryButton type="button" onClick={onClose}>
                            Отмена
                        </SecondaryButton>
                        <PrimaryButton type="submit" disabled={isProcessing}>
                            {isProcessing ? 'Сохранение...' : 'Сохранить'}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </Modal>
    );
}
