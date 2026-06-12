
import GuestLayout from '@/Layouts/GuestLayout';
import HeroSection from '../Layouts/Main';
import { Head } from '@inertiajs/react';
import Header from '@/Layouts/Header';

export default function Welcome({ auth, doctors, laravelVersion, phpVersion }) {
    const user = auth?.user || null;
    const role = user?.role || (user?.roles?.[0]?.name ?? null);
    const isDoctor = role === 'doctor';

    return (
        <GuestLayout auth={auth}>
            
            <Head title="MedSystem - Медицинская информационная система" />
            
      <HeroSection auth={auth} />

         

         
            <section id="doctors" className="py-16 bg-gray-50">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="text-center mb-12">
                        <h2 className="text-3xl font-bold text-gray-900 mb-4">Наши врачи</h2>
                        <p className="text-gray-600">Высококвалифицированные специалисты</p>
                    </div>

                 <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {doctors.map((doctor) => (
                            <div key={doctor.id} className="bg-white rounded-xl p-6 text-center shadow hover:shadow-lg transition">
                                <div className="h-24 w-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <svg className="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h3 className="text-lg font-semibold text-gray-900">{doctor.name}</h3>
                                <p className="text-gray-600 text-sm">{doctor.specialization}</p>
                            </div>
                        ))}
                    </div>
                </div>
            </section>

       
           
        </GuestLayout>
    );
}