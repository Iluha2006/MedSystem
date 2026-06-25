
export default function Footer() {
    const currentYear = new Date().getFullYear();

    return (
        <footer className="bg-gray-900 text-white mt-20">
            <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {/* О нас */}
                    <div>
                        <div className="flex items-center space-x-2 mb-4">
                            <div className="h-10 w-10 bg-gradient-to-r from-blue-600 to-teal-500 rounded-xl flex items-center justify-center">
                                <svg className="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span className="text-xl font-bold">MedSystem</span>
                        </div>
                        <p className="text-gray-400 text-sm">
                            Современная медицинская информационная система для управления здравоохранением.
                        </p>
                    </div>

                   

                  
                    <div>
                        <h3 className="text-lg font-semibold mb-4">Отделения</h3>
                        <ul className="space-y-2 text-gray-400">
                            <li><a href="#departments" className="hover:text-white transition">Кардиология</a></li>
                            <li><a href="#departments" className="hover:text-white transition">Неврология</a></li>
                            <li><a href="#departments" className="hover:text-white transition">Хирургия</a></li>
                            <li><a href="#departments" className="hover:text-white transition">Терапия</a></li>
                        </ul>
                    </div>

                  
                    <div>
                        <h3 className="text-lg font-semibold mb-4">Контакты</h3>
                        <ul className="space-y-2 text-gray-400">
                            <li className="flex items-center space-x-2">
                                <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>г. Москва, ул. Медицинская, 10</span>
                            </li>
                            <li className="flex items-center space-x-2">
                                <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>+7 (800) 123-45-67</span>
                            </li>
                            <li className="flex items-center space-x-2">
                                <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>info@medsystem.ru</span>
                            </li>
                        </ul>
                    </div>
                </div>

               
                <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                    <p>&copy; {currentYear} MedSystem. Все права защищены.</p>
                    <p className="mt-2">Курсовой проект - Медицинская информационная система</p>
                </div>
            </div>
        </footer>
    );
}