import { Link, router } from '@inertiajs/react';
import { useState } from 'react';

export default function Header({ auth }) {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [profileDropdownOpen, setProfileDropdownOpen] = useState(false);

    const user = auth?.user || null;
    
    
    const getUserRole = () => {
        if (!user) return null;
        if (user.role) return user.role;
        if (user.roles && user.roles.length > 0 && user.roles[0]?.name) return user.roles[0].name;
       
    };
    
    const role = getUserRole();
    const isDoctor = role === 'doctor';
    const isPatient = role === 'patient';

    
    const navigation = [
        { name: 'Главная', href: '/', current: true },
      
        { name: 'Отделения', href: '/departments' },
       
    ];

  
    const getAuthNavigation = () => {
        if (!user) return [];
        
        const navPatient = [];
        const navDoctor=[]
        
      
        if (isPatient) {
            navPatient.push({ name: 'Мои записи', href: '/visits' });
        }
        
      
        if (isDoctor) {
            navDoctor.push({ name: 'Мои пациенты', href: '/doctor/appointments' });
         
        }
        
        return [...navDoctor, ...navPatient]
       
    };

    const authNavigation = getAuthNavigation();
    const headerNavigation = [...navigation, ...authNavigation];

 
    const getDropdownNavigation = () => {
        if (!user || !isDoctor) return [];
        
        return [
            { name: ' Мои пациенты', href: '/doctor/appointments' },
          
        ];
    };

    const dropdownNavigation = getDropdownNavigation();

    const handleAuth = () => {
        router.get("/register");
    };

    return (
        <header className="bg-white shadow-md sticky top-0 z-50">
            <nav className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div className="flex h-16 justify-between items-center">

                    <Link href="/" className="flex items-center space-x-3">
                        <div className="h-10 w-10 bg-gradient-to-r from-blue-600 to-teal-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg className="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h1 className="text-xl font-bold bg-gradient-to-r from-blue-600 to-teal-500 bg-clip-text text-transparent">
                                MedSystem
                            </h1>
                            <p className="text-xs text-gray-500">Медицинская информационная система</p>
                        </div>
                    </Link>

                    <div className="hidden md:flex items-center space-x-8">
                        {headerNavigation.map((item) => (
                            <Link
                                key={item.name}
                                href={item.href}
                                className="text-gray-700 hover:text-blue-600 transition duration-300 font-medium"
                            >
                                {item.name}
                            </Link>
                        ))}

                        {user ? (
                            <div className="relative ml-4">
                                <button
                                    onClick={() => setProfileDropdownOpen(!profileDropdownOpen)}
                                    className="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition focus:outline-none"
                                >
                                    <div className="h-8 w-8 bg-gradient-to-r from-blue-600 to-teal-500 rounded-full flex items-center justify-center">
                                        <span className="text-sm font-medium text-white">
                                            {user.name?.charAt(0)?.toUpperCase() || 'U'}
                                        </span>
                                    </div>
                                    <span className="text-sm font-medium">{user.name}</span>
                                    <svg className="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                {profileDropdownOpen && (
                                    <>
                                        <div
                                            className="fixed inset-0 z-40"
                                            onClick={() => setProfileDropdownOpen(false)}
                                        />
                                        <div className="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100">

                                            <div className="px-4 py-3 border-b border-gray-100">
                                                <div className="text-sm font-semibold text-gray-900">{user.name}</div>
                                                <div className="text-xs text-gray-500 mt-1">{user.email}</div>
                                                <div className="text-xs mt-1">
                                                    <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${
                                                        isDoctor ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'
                                                    }`}>
                                                        {isDoctor ? 'Врач' : 'Пациент'}
                                                    </span>
                                                </div>
                                            </div>

                                           
                                            {dropdownNavigation.length > 0 && (
                                                <>
                                                    {dropdownNavigation.map((item) => (
                                                        <Link
                                                            key={item.name}
                                                            href={item.href}
                                                            className="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition"
                                                            onClick={() => setProfileDropdownOpen(false)}
                                                        >
                                                            {item.name}
                                                        </Link>
                                                    ))}
                                                    <div className="border-t border-gray-100 my-1"></div>
                                                </>
                                            )}

                                            
                                            

                                            <div className="border-t border-gray-100 my-1"></div>

                                            <Link
                                                href={route('logout')}
                                                method="post"
                                                as="button"
                                                className="flex w-full items-center px-4 py-2 text-red-600 hover:bg-red-50 transition"
                                                onClick={() => setProfileDropdownOpen(false)}
                                            >
                                                <svg className="h-5 w-5 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Выход из системы
                                            </Link>
                                        </div>
                                    </>
                                )}
                            </div>
                        ) : (
                            <div className="flex items-center space-x-4">
                                <button
                                    onClick={handleAuth}
                                    className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 font-medium text-sm shadow-sm hover:shadow-md inline-flex items-center gap-2"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" className="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                    </svg>
                                    <span>Личный кабинет</span>
                                </button>
                            </div>
                        )}
                    </div>

                    <div className="md:hidden">
                        <button
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            className="text-gray-700 hover:text-blue-600"
                        >
                            <svg className="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {mobileMenuOpen ? (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                ) : (
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
                                )}
                            </svg>
                        </button>
                    </div>
                </div>

                {mobileMenuOpen && (
                    <div className="md:hidden py-4 border-t">
                        {headerNavigation.map((item) => (
                            <Link
                                key={item.name}
                                href={item.href}
                                className="block py-2 text-gray-700 hover:text-blue-600 transition"
                                onClick={() => setMobileMenuOpen(false)}
                            >
                                {item.name}
                            </Link>
                        ))}

                        {user ? (
                            <>
                                <div className="pt-4 border-t mt-2">
                                    <div className="px-2 py-2">
                                        <div className="text-sm font-medium text-gray-900">{user.name}</div>
                                        <div className="text-sm text-gray-500">{user.email}</div>
                                    </div>
                                    <Link
                                        href={route('profile.edit')}
                                        className="block px-2 py-2 text-gray-700 hover:text-blue-600 transition"
                                        onClick={() => setMobileMenuOpen(false)}
                                    >
                                        Профиль
                                    </Link>
                                    <Link
                                        href={route('logout')}
                                        method="post"
                                        as="button"
                                        className="block w-full text-left px-2 py-2 text-red-600 hover:text-red-700 transition"
                                        onClick={() => setMobileMenuOpen(false)}
                                    >
                                        Выход
                                    </Link>
                                </div>
                            </>
                        ) : (
                            <div className="pt-4 space-y-2">
                                <Link
                                    href={route('login')}
                                    className="block text-center text-gray-700 hover:text-blue-600 py-2"
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    Вход
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="block text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    Регистрация
                                </Link>
                            </div>
                        )}
                    </div>
                )}
            </nav>
        </header>
    );
}