
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import Header from '../../Layouts/Header';
import Footer from '../../Layouts/footer';
import AppointmentCard from '../../Components/AppointmentCard';
import AppointmentModal from '../../Components/AppointmentModal';

export default function DoctorAppointments({ appointments, cabinets, auth }) {
    const [selectedAppointment, setSelectedAppointment] = useState(null);
    const [formData, setFormData] = useState({});
    const [isProcessing, setIsProcessing] = useState(false);

    const handleEdit = (appointment) => {
        setSelectedAppointment(appointment);
        setFormData({
            status: appointment.status,
            assigned_cabinet_id: appointment.assigned_cabinet_id || '',
            diagnosis: appointment.diagnosis || '',
            complaint: appointment.complaint || '',
            prescription: appointment.prescription || '',
        });
    };

    const handleUpdate = (e) => {
        e.preventDefault();
        setIsProcessing(true);
        router.put(route('doctor.appointments.update', selectedAppointment.id), formData, {
            onSuccess: () => {
                setSelectedAppointment(null);
                setIsProcessing(false);
            },
            onError: () => setIsProcessing(false),
        });
    };

    const handleComplete = (appointment) => {
        const diagnosis = prompt('Введите диагноз:');
        if (diagnosis) {
            const prescription = prompt('Введите назначение (лекарства, процедуры):');
            router.post(route('doctor.appointments.complete', appointment.id), {
                diagnosis,
                prescription: prescription || null,
            });
        }
    };

    const handleCancel = (id) => {
        if (confirm('Вы уверены, что хотите отменить эту запись?')) {
            router.post(route('doctor.appointments.cancel', id));
        }
    };

    return (
        <div className="min-h-screen bg-gray-50 flex flex-col">
            <Header auth={auth} />

            <Head title="Мои записи" />

            <main className="flex-grow py-12">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 className="text-2xl font-bold text-gray-900 mb-6">
                        Мои записи пациентов
                    </h1>

                    {appointments.length === 0 ? (
                        <div className="bg-white rounded-xl shadow p-8 text-center">
                            <svg
                                className="h-16 w-16 text-gray-400 mx-auto mb-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                />
                            </svg>
                            <p className="text-gray-500">Нет записей</p>
                        </div>
                    ) : (
                        <div className="grid gap-4">
                            {appointments.map((appointment) => (
                                <AppointmentCard
                                    key={appointment.id}
                                    appointment={appointment}
                                    onEdit={handleEdit}
                                    onComplete={handleComplete}
                                    onCancel={handleCancel}
                                />
                            ))}
                        </div>
                    )}
                </div>
            </main>

            <AppointmentModal
                appointment={selectedAppointment}
                formData={formData}
                cabinets={cabinets}
                isProcessing={isProcessing}
                onClose={() => setSelectedAppointment(null)}
                onChange={setFormData}
                onSubmit={handleUpdate}
            />

            <Footer />
        </div>
    );
}