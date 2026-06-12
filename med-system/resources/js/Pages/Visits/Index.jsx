
import { Head, Link } from '@inertiajs/react';
import { router } from '@inertiajs/react';
import Header from '../../Layouts/Header';
import Footer from '../../Layouts/footer';

export default function VisitsIndex({ visits, can, auth }) {
    const handleCancel = (visitId) => {
        if (confirm('Вы уверены, что хотите отменить эту запись?')) {
            router.delete(route('visits.destroy', { visit: visitId }));
        }
    };

    const handleConfirm = (visitId) => {
        router.post(route('visits.confirm', { visit: visitId }));
    };

    const getStatusBadge = (status) => {
        const statuses = {
            pending: { text: 'Ожидает подтверждения', color: 'bg-yellow-100 text-yellow-800' },
            confirmed: { text: 'Подтверждена', color: 'bg-green-100 text-green-800' },
            cancelled: { text: 'Отменена', color: 'bg-red-100 text-red-800' },
            completed: { text: 'Завершена', color: 'bg-gray-100 text-gray-800' },
        };
        const s = statuses[status] || statuses.pending;
        return <span className={`px-2 py-1 rounded-full text-xs font-medium ${s.color}`}>{s.text}</span>;
    };

    return (
        <div className="min-h-screen bg-gray-50 flex flex-col">
            <Header auth={auth} />
            
            <Head title="Мои записи" />

            <main className="flex-grow py-12">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center mb-6">
                        <h1 className="text-2xl font-bold text-gray-900">Мои записи к врачу</h1>
                        {can.create && (
                            <Link
                                href={route('visits.create')}
                                className="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition"
                            >
                                + Новая запись
                            </Link>
                        )}
                    </div>

                    {visits.length === 0 ? (
                        <div className="bg-white rounded-xl shadow p-8 text-center">
                            <svg className="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p className="text-gray-500 mb-4">У вас пока нет записей к врачу</p>
                            {can.create && (
                                <Link
                                    href={route('visits.create')}
                                    className="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition"
                                >
                                    Создать первую запись
                                </Link>
                            )}
                        </div>
                    ) : (
                        <div className="grid gap-4">
                            {visits.map((visit) => (
                                <div key={visit.id} className="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                                    <div className="flex flex-wrap justify-between items-start">
                                        <Link href={route('visits.show', visit.id)} className="flex-1 group">
                                            <div className="flex items-center gap-2 mb-2">
                                                <h3 className="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">
                                                    {visit.doctor?.name}
                                                </h3>
                                                {getStatusBadge(visit.status)}
                                            </div>
                                            <p className="text-gray-600 mb-1">
                                                <span className="font-medium">Специализация:</span> {visit.doctor?.specialty?.name || 'Не указана'}
                                            </p>
                                            <p className="text-gray-600 mb-1">
                                                <span className="font-medium">Учреждение:</span> {visit.facility?.name}
                                            </p>
                                            <p className="text-gray-600">
                                                <span className="font-medium">Дата и время:</span>{' '}
                                                {new Date(visit.visit_date).toLocaleString('ru-RU')}
                                            </p>
                                        </Link>

                                        <div className="flex gap-2 mt-4 md:mt-0">
                                            {can.confirm && visit.status === 'pending' && (
                                                <button
                                                    onClick={() => handleConfirm(visit.id)}
                                                    className="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm"
                                                >
                                                    Подтвердить
                                                </button>
                                            )}
                                            {can.update && visit.status === 'pending' && (
                                                <Link
                                                    href={route('visits.edit', visit.id)}
                                                    className="px-3 py-1 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm"
                                                >
                                                    Редактировать
                                                </Link>
                                            )}
                                            {can.delete && visit.status === 'pending' && (
                                                <button
                                                    onClick={() => handleCancel(visit.id)}
                                                    className="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm"
                                                >
                                                    Отменить
                                                </button>
                                            )}
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </main>

            <Footer />
        </div>
    );
}