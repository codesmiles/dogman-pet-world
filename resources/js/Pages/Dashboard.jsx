import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function Dashboard({ auth }) {
    const searchParams = window.location.search.split("?")[1]?.split("=");

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
        {
            searchParams && searchParams[0] == "error" &&  (
                <div
                    className="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50  w-11/12 mx-auto"
                    role="alert"
                >
                    <span className="font-medium uppercase">{searchParams[0]}</span>: <span className="lowercase">{searchParams[1]}</span>
                </div>
            )
        }


            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            You're logged in!
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
