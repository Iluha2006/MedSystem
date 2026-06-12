import { Head, Link, useForm } from '@inertiajs/react';
import Header from '../../Layouts/Header';
import Footer from '../../Layouts/footer';
import { useState, useEffect } from 'react';

export default function VisitsCreate({ doctors, auth }) {
    const { data, setData, post, processing, errors } = useForm({
        doctor_id: '',
        visit_date: '',
        complaint: '',
    });

    const [selectedDoctor, setSelectedDoctor] = useState(null);
  
    useEffect(() => {
        console.log('Doctors from server:', doctors);
    }, []);

    const doctorsList = Array.isArray(doctors) ? doctors : [];

    const handleDoctorChange = (e) => {
        const doctorId = parseInt(e.target.value);
        const doctor = doctorsList.find(d => d.id === doctorId);
        console.log('Selected doctor:', doctor);
        setSelectedDoctor(doctor);
        setData('doctor_id', doctorId);
    };

    const submit = (e) => {
        e.preventDefault();
        post(route('visits.store'));
    };

    const minDate = new Date().toISOString().slice(0, 16);
    
    if (doctorsList.length === 0 && doctors !== undefined) {
        return (
            <div className="min-h-screen bg-gray-50 flex flex-col">
                <Header auth={auth} />
                <main className="flex-grow py-12">
                    <div className="text-center">Загрузка списка врачей...</div>
                </main>
                <Footer />
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gray-50 flex flex-col">
            <Header auth={auth} />
            
            <Head title="Новая запись" />

            <main className="flex-grow py-12">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <div className="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div className="bg-gradient-to-r from-blue-600 to-teal-500 px-6 py-4">
                            <h1 className="text-xl font-bold text-white">Запись к врачу</h1>
                            <p className="text-blue-100 text-sm">Заполните форму для записи на прием</p>
                        </div>

                        <form onSubmit={submit} className="p-6 space-y-6">
                          
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Выберите врача *
                                </label>
                                <select
                                    value={data.doctor_id}
                                    onChange={handleDoctorChange}
                                    className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    required
                                >
                                    <option value="">-- Выберите врача --</option>
                                    {doctorsList.map((doctor) => (
                                        <option key={doctor.id} value={doctor.id}>
                                            {doctor.name} - {doctor.specialty || 'Специализация не указана'}
                                        </option>
                                    ))}
                                </select>
                                {errors.doctor_id && (
                                    <p className="text-red-500 text-sm mt-1">{errors.doctor_id}</p>
                                )}
                            </div>

                        
                            {selectedDoctor && (
                                <div className="bg-blue-50 rounded-lg p-4 border border-blue-200">
                                    <h3 className="font-medium text-blue-800 mb-2">Информация о враче</h3>
                                    
                                    <p className="text-sm text-blue-700">
                                        <span className="font-medium">Специализация:</span> {selectedDoctor.specialty || 'Не указана'}
                                    </p>
                                    
                                    <p className="text-sm text-blue-700 mt-1">
                                        <span className="font-medium">Стаж:</span> {selectedDoctor.experience_years || 'Нет данных'} лет
                                    </p>
                                    
                                    {selectedDoctor.facility_names && (
                                        <div className="mt-3 pt-2 border-t border-blue-200">
                                            <p className="text-sm text-blue-700">
                                                <span className="font-medium"> Место работы:</span> {selectedDoctor.facility_names}
                                            </p>
                                        </div>
                                    )}
                                    
                                    {!selectedDoctor.facility_names && (
                                        <div className="mt-2 text-sm text-blue-600">
                                             Место работы не указано
                                        </div>
                                    )}
                                </div>
                            )}

                   
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Дата и время *
                                </label>
                                <input
                                    type="datetime-local"
                                    value={data.visit_date}
                                    onChange={(e) => setData('visit_date', e.target.value)}
                                    min={minDate}
                                    className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    required
                                />
                                {errors.visit_date && (
                                    <p className="text-red-500 text-sm mt-1">{errors.visit_date}</p>
                                )}
                            </div>

                          
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Опишите вашу проблему или жалобы 
                                </label>
                                <textarea
                                    value={data.complaint}
                                    onChange={(e) => setData('complaint', e.target.value)}
                                    rows="3"
                                    className="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Что вас беспокоит? Например: головная боль, боль в груди, повышенное давление..."
                                    required
                                />
                                {errors.complaint && (
                                    <p className="text-red-500 text-sm mt-1">{errors.complaint}</p>
                                )}
                            </div>

                            <div className="flex justify-end gap-3 pt-4 border-t">
                                <Link
                                    href={route('visits.index')}
                                    className="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                                >
                                    Отмена
                                </Link>
                                <button
                                    type="submit"
                                    disabled={processing}
                                    className="px-4 py-2 bg-gradient-to-r from-blue-600 to-teal-500 text-white rounded-lg hover:from-blue-700 hover:to-teal-600 transition disabled:opacity-50"
                                >
                                    {processing ? 'Сохранение...' : 'Записаться'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>

            <Footer />
        </div>
    );
}