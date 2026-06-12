import { Head, Link } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';

export default function DepartmentsIndex({ auth, departments }) {
    return (
        <GuestLayout auth={auth}>
            <Head title="Отделения" />

            <div className="py-16">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <h1 className="text-3xl font-bold text-gray-900 mb-4">Наши отделения</h1>
                        <p className="text-gray-600">Специализированные отделения с высококвалифицированным персоналом</p>
                    </div>

                    {departments.length === 0 ? (
                        <div className="bg-white rounded-xl shadow p-8 text-center">
                            <p className="text-gray-500">Нет доступных отделений</p>
                        </div>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {departments.map((dept) => (
                                <Link
                                    key={dept.id}
                                    href={route('departments.show', dept.id)}
                                    className="bg-white rounded-xl shadow p-6 hover:shadow-lg transition group"
                                >
                                    <div className="h-14 w-14 bg-gradient-to-r from-blue-600 to-teal-500 rounded-xl flex items-center justify-center mb-4 shadow-md">
                                        <svg className="h-7 w-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <h3 className="text-xl font-semibold text-gray-900 group-hover:text-blue-600 transition mb-2">
                                        {dept.name}
                                    </h3>
                                    <p className="text-gray-600 mb-1">{dept.specialization}</p>
                                    <p className="text-sm text-gray-500">
                                        {dept.facility} — {dept.building}
                                    </p>
                                    <div className="mt-4 pt-4 border-t border-gray-100">
                                        <span className="text-sm text-gray-500">
                                            Врачей: {dept.doctor_count}
                                        </span>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </GuestLayout>
    );
}
