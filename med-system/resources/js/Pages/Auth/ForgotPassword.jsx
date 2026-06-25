import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function ForgotPassword({ status }) {
    const { data, setData, post, processing, errors } = useForm({
        email: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('password.email'));
    };

    return (
        <GuestLayout>
            <Head title="Восстановление пароля" />

            <div className="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-r">
                <div className="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-2xl p-8">
                    <div className="text-center">
                        <div className="flex justify-center">
                            <div className="h-16 w-16 bg-gradient-to-r from-blue-600 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg className="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                            </div>
                        </div>
                        <h2 className="mt-6 text-3xl font-extrabold text-gray-900">
                            MedSystem
                        </h2>
                        <p className="mt-2 text-sm text-gray-600">
                            Медицинская информационная система
                        </p>
                    </div>

                    <div className="text-center">
                        <h3 className="text-xl font-semibold text-gray-800">Восстановление пароля</h3>
                        <p className="text-sm text-gray-500 mt-1">
                            Введите ваш email, и мы отправим ссылку для сброса пароля
                        </p>
                    </div>

                    {status && (
                        <div className="text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg p-3">
                            {status}
                        </div>
                    )}

                    <form onSubmit={submit} className="mt-8 space-y-6">
                        <div>
                            <InputLabel htmlFor="email" value="Email" className="text-gray-700 font-medium" />
                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                isFocused={true}
                                onChange={(e) => setData('email', e.target.value)}
                                placeholder="doctor@example.com"
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        <div>
                            <PrimaryButton
                                className="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-teal-500 hover:from-blue-700 hover:to-teal-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                disabled={processing}
                            >
                                {processing ? 'Отправка...' : 'Отправить ссылку'}
                            </PrimaryButton>
                        </div>

                        <div className="text-center">
                            <p className="text-sm text-gray-600">
                                Вспомнили пароль?{' '}
                                <Link
                                    href={route('login')}
                                    className="text-blue-600 hover:text-blue-500 font-medium"
                                >
                                    Вернуться ко входу
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </GuestLayout>
    );
}
