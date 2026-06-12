import { Head, Link, router } from '@inertiajs/react';
import Header from '../../Layouts/Header';
import Footer from '../../Layouts/footer';

export default function VisitsShow({ visit, auth }) {
    const statusLabels = {
        pending: { text: 'Ожидает подтверждения', color: 'bg-yellow-100 text-yellow-800' },
        scheduled: { text: 'Запланирован', color: 'bg-blue-100 text-blue-800' },
        confirmed: { text: 'Подтверждён', color: 'bg-green-100 text-green-800' },
        cancelled: { text: 'Отменён', color: 'bg-red-100 text-red-800' },
        completed: { text: 'Завершён', color: 'bg-gray-100 text-gray-800' },
    };


   const facilityName = visit.facility?.name || 
                    visit.doctor?.facilities?.[0]?.name || 
                    'Не указано';


    const s = statusLabels[visit.status] || statusLabels.pending;

    return (
        <div className="min-h-screen bg-gray-50 flex flex-col">
            <Header auth={auth} />

            <Head title={`Запись к ${visit.doctor?.name}`} />

            <main className="flex-grow py-12">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <Link
                        href={route('visits.index')}
                        className="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6"
                    >
                        &larr; Назад к записям
                    </Link>

                    <div className="bg-white rounded-xl shadow overflow-hidden">
                        <div className="p-6 border-b border-gray-200">
                            <div className="flex justify-between items-start">
                                <h1 className="text-2xl font-bold text-gray-900">
                                    Приём у {visit.doctor?.name}
                                </h1>
                                <span className={`px-3 py-1 rounded-full text-sm font-medium ${s.color}`}>
                                    {s.text}
                                </span>
                            </div>
                        </div>

                        <div className="p-6 space-y-6">
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500">Врач</h3>
                                    <p className="text-gray-900">{visit.doctor?.name}</p>
                                </div>
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500">Специализация</h3>
                                    <p className="text-gray-900">{visit.doctor?.specialty?.name || 'Не указана'}</p>
                                </div>
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500">Учреждение</h3>
                                        <p className="text-gray-900">{facilityName}</p>
                                </div>
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500">Дата и время</h3>
                                    <p className="text-gray-900">
                                        {new Date(visit.visit_date).toLocaleString('ru-RU')}
                                    </p>
                                </div>
                            </div>

                            {visit.complaint && (
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500 mb-1">Жалобы</h3>
                                    <p className="text-gray-900 bg-gray-50 rounded-lg p-3">{visit.complaint}</p>
                                </div>
                            )}

                            {visit.diagnosis && (
                                <div>
                                    <h3 className="text-sm font-medium text-gray-500 mb-1">Диагноз</h3>
                                    <p className="text-gray-900 bg-gray-50 rounded-lg p-3">{visit.diagnosis}</p>
                                </div>
                            )}

                            {visit.prescription && (
                                <div className="border-t border-gray-200 pt-6">
                                    <h2 className="text-lg font-semibold text-gray-900 mb-3">
                                        Назначение врача
                                    </h2>
                                    <div className="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                        <p className="text-gray-900 whitespace-pre-wrap">{visit.prescription}</p>
                                    </div>
                                </div>
                            )}

                            {visit.status === 'cancelled' && (
                                <div className="bg-red-50 rounded-lg p-4 border border-red-200">
                                    <p className="text-red-700">Запись отменена</p>
                                </div>
                            )}
                        </div>

                        <div className="p-6 bg-gray-50 border-t border-gray-200">
                            <Link
                                href={route('visits.index')}
                                className="text-blue-600 hover:text-blue-800"
                            >
                                &larr; Вернуться к списку
                            </Link>
                        </div>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}