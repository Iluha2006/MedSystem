
import { Link } from '@inertiajs/react';

export default function HeroSection({ auth }) {
    const user = auth?.user || null;
    const role = user?.role || null;
    const isDoctor = role === 'doctor';
    const isPatient = role === 'patient';

    return (
        <section className="bg-gradient-to-r from-blue-600 to-teal-500 text-white py-20">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div className="text-center">
                    <h1 className="text-4xl md:text-6xl font-bold mb-6">
                        Медицинская информационная система
                    </h1>

                    <div className="bg-white/10 backdrop-blur-sm rounded-2xl p-8 max-w-2xl mx-auto">
                        {isDoctor ? (
                            <>
                                <h2 className="text-2xl font-semibold mb-4">
                                    Область для врача
                                </h2>
                                <p className="text-lg mb-6">
                                    Управляйте приемами пациентов, просматривайте историю болезней,
                                    назначайте лечение и многое другое
                                </p>
                                <Link
                                    href={route('doctor.appointments')}
                                    className="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition"
                                >
                                    Мои пациенты
                                </Link>
                            </>
                        ) : isPatient ? (
                            <>
                                <h2 className="text-2xl font-semibold mb-4">
                                    Область для пациента
                                </h2>
                                <p className="text-lg mb-6">
                                    Записывайтесь к врачу онлайн, просматривайте историю посещений,
                                    получайте результаты анализов и многое другое
                                </p>
                                <Link
                                    href={route('visits.index')}
                                    className="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition"
                                >
                                    Личный кабинет
                                </Link>
                            </>
                        ) : (
                            <>
                                <h2 className="text-2xl font-semibold mb-4">
                                    Область для пациента
                                </h2>
                                <p className="text-lg mb-6">
                                    Записывайтесь к врачу онлайн, просматривайте историю посещений,
                                    получайте результаты анализов и многое другое
                                </p>
                                <div className="space-x-4">
                                    <Link
                                        href="/login"
                                        className="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition"
                                    >
                                        Войти в систему
                                    </Link>
                                    <Link
                                        href="/register"
                                        className="inline-block border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition"
                                    >
                                        Зарегистрироваться
                                    </Link>
                                </div>
                            </>
                        )}
                    </div>
                </div>
            </div>
        </section>
    );
}