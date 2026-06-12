import { Head, Link } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function DepartmentShow({ auth, department, doctors }) {
    return (
        <GuestLayout auth={auth}>
            <Head title={department.name} />

            <div className="py-16">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="mb-8">
                        <Link
                            href={route('departments.index')}
                            className="text-blue-600 hover:text-blue-700 transition inline-flex items-center gap-1"
                        >
                            <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
                            </svg>
                            Назад к отделениям
                        </Link>
                    </div>

                    <div className="bg-white rounded-xl shadow p-8 mb-10">
                        <div className="flex items-start gap-6">
                            <div className="h-20 w-20 bg-gradient-to-r from-blue-600 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg shrink-0">
                                <svg className="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h1 className="text-3xl font-bold text-gray-900 mb-2">{department.name}</h1>
                                <p className="text-lg text-gray-600 mb-1">{department.specialization}</p>
                                <p className="text-gray-500">
                                    {department.facility} — {department.building}
                                </p>
                                {department.facility_address && (
                                    <p className="text-gray-400 text-sm mt-1">
                                        {department.facility_address}
                                    </p>
                                )}
                            </div>
                        </div>
                    </div>

                    <h2 className="text-2xl font-bold text-gray-900 mb-6">Врачи отделения</h2>

                    {doctors.length === 0 ? (
                        <div className="bg-white rounded-xl shadow p-8 text-center">
                            <svg className="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <p className="text-gray-500">В этом отделении пока нет врачей</p>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {doctors.map((doctor) => (
                                <div key={doctor.id} className="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                                    <div className="flex items-center gap-4 mb-4">
                                        <div className="h-14 w-14 bg-gradient-to-r from-blue-600 to-teal-500 rounded-full flex items-center justify-center shadow-md shrink-0">
                                            <span className="text-xl font-bold text-white">
                                                {doctor.name.charAt(0)}
                                            </span>
                                        </div>
                                        <div>
                                            <h3 className="text-lg font-semibold text-gray-900">{doctor.name}</h3>
                                            <p className="text-sm text-blue-600">{doctor.specialty}</p>
                                        </div>
                                    </div>

                                    <div className="space-y-2 text-sm text-gray-600">
                                        {doctor.degree && (
                                            <div className="flex items-center gap-2">
                                                <svg className="h-4 w-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                </svg>
                                                <span>{doctor.degree}</span>
                                            </div>
                                        )}
                                        {doctor.academic_title && (
                                            <div className="flex items-center gap-2">
                                                <svg className="h-4 w-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                                </svg>
                                                <span>{doctor.academic_title}</span>
                                            </div>
                                        )}
                                        <div className="flex items-center gap-2">
                                            <svg className="h-4 w-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Стаж: {doctor.experience_years} {doctor.experience_years === 1 ? 'год' : doctor.experience_years < 5 ? 'года' : 'лет'}</span>
                                        </div>
                                        {doctor.hazard_coeff > 0 && (
                                            <div className="flex items-center gap-2">
                                                <svg className="h-4 w-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                </svg>
                                                <span>Коэфф. вредности: {doctor.hazard_coeff}</span>
                                            </div>
                                        )}
                                    </div>

                                    <div className="mt-4 pt-4 border-t border-gray-100">
                                        <Link
                                            href={route('visits.create', { doctor_id: doctor.id })}
                                            className="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700 transition font-medium"
                                        >
                                            Записаться к врачу
                                            <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </GuestLayout>
    );
}
