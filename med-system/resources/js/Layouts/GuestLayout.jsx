
import Header from '../Layouts/Header';
import Footer from '../Layouts/footer';

export default function GuestLayout({ children, auth }) {
    return (
        <div className="min-h-screen bg-gray-50 flex flex-col">
            <Header auth={auth} />  
            <main className="flex-grow">
                {children}
            </main>
            <Footer />
        </div>
    );
}