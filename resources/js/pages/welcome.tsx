import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="English Booster - Affiliate Marketing System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="w-full px-6 py-4">
                    <nav className="flex items-center justify-between max-w-7xl mx-auto">
                        <div className="flex items-center space-x-2">
                            <div className="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold text-lg">EB</span>
                            </div>
                            <span className="text-xl font-bold text-gray-900 dark:text-white">English Booster</span>
                        </div>
                        
                        <div className="flex items-center space-x-4">
                            {auth.user ? (
                                <>
                                    <Link
                                        href={route('affiliate.dashboard')}
                                        className="px-4 py-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors"
                                    >
                                        Affiliate Dashboard
                                    </Link>
                                    <Link
                                        href={route('dashboard')}
                                        className="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Dashboard
                                    </Link>
                                </>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-600 hover:text-gray-700 dark:text-gray-300 dark:hover:text-gray-200 transition-colors"
                                    >
                                        Login
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Join as Affiliate
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <main className="max-w-7xl mx-auto px-6 py-12">
                    <div className="text-center mb-16">
                        <h1 className="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                            🚀 English Booster
                            <span className="block text-blue-600">Affiliate System</span>
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                            Join Indonesia's premier English course affiliate program and earn generous commissions 
                            while helping students achieve their English learning goals.
                        </p>
                        
                        <div className="flex flex-col sm:flex-row justify-center gap-4 mb-12">
                            {!auth.user && (
                                <Link
                                    href={route('register')}
                                    className="px-8 py-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-lg font-semibold"
                                >
                                    🎯 Become an Affiliate
                                </Link>
                            )}
                            <Link
                                href="#programs"
                                className="px-8 py-4 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors text-lg font-semibold"
                            >
                                📚 View Programs
                            </Link>
                        </div>
                    </div>

                    {/* Company Info */}
                    <div className="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mb-16">
                        <div className="grid md:grid-cols-2 gap-8">
                            <div>
                                <h2 className="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                                    🏢 About English Booster
                                </h2>
                                <div className="space-y-3 text-gray-600 dark:text-gray-300">
                                    <p className="flex items-center">
                                        <span className="mr-3">📍</span>
                                        <span>Jl. Asparaga No.100, Tegalsari, Tulungrejo, Pare, Kediri</span>
                                    </p>
                                    <p className="flex items-center">
                                        <span className="mr-3">📞</span>
                                        <span>0822-3105-0500</span>
                                    </p>
                                    <p className="flex items-center">
                                        <span className="mr-3">📱</span>
                                        <span>@kampunginggrisbooster</span>
                                    </p>
                                </div>
                            </div>
                            <div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-4">
                                    🎯 Why Partner With Us?
                                </h3>
                                <ul className="space-y-2 text-gray-600 dark:text-gray-300">
                                    <li className="flex items-start">
                                        <span className="mr-2 text-green-500">✅</span>
                                        <span>Industry-leading commission rates (15-30%)</span>
                                    </li>
                                    <li className="flex items-start">
                                        <span className="mr-2 text-green-500">✅</span>
                                        <span>Comprehensive tracking & analytics</span>
                                    </li>
                                    <li className="flex items-start">
                                        <span className="mr-2 text-green-500">✅</span>
                                        <span>Ready-to-use marketing materials</span>
                                    </li>
                                    <li className="flex items-start">
                                        <span className="mr-2 text-green-500">✅</span>
                                        <span>Multiple program types & locations</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {/* Programs Section */}
                    <section id="programs" className="mb-16">
                        <h2 className="text-4xl font-bold text-center text-gray-900 dark:text-white mb-12">
                            📚 Our Programs
                        </h2>
                        
                        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                            {/* Online Programs */}
                            <div className="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-6">
                                <div className="text-3xl mb-4">💻</div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">Online Programs</h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-3">Learn from anywhere</p>
                                <ul className="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <li>• Kids & Teen English</li>
                                    <li>• TOEFL Preparation</li>
                                    <li>• Speaking & Grammar Booster</li>
                                    <li>• Private Tutoring</li>
                                </ul>
                                <div className="mt-4 text-sm font-semibold text-green-600 dark:text-green-400">
                                    Commission: 15-25%
                                </div>
                            </div>

                            {/* Offline Programs */}
                            <div className="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6">
                                <div className="text-3xl mb-4">🏫</div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">Offline Kediri</h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-3">Campus-based learning</p>
                                <ul className="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <li>• 2-week to 3-month programs</li>
                                    <li>• TOEFL & RPL courses</li>
                                    <li>• Cruise Ship English</li>
                                    <li>• Intensive immersion</li>
                                </ul>
                                <div className="mt-4 text-sm font-semibold text-blue-600 dark:text-blue-400">
                                    Commission: 20-30%
                                </div>
                            </div>

                            {/* Group Programs */}
                            <div className="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl p-6">
                                <div className="text-3xl mb-4">👥</div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">Group Programs</h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-3">For institutions</p>
                                <ul className="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <li>• English Trip</li>
                                    <li>• Special English Day</li>
                                    <li>• Tutor Visit Program</li>
                                    <li>• Customized packages</li>
                                </ul>
                                <div className="mt-4 text-sm font-semibold text-purple-600 dark:text-purple-400">
                                    Commission: 15-20%
                                </div>
                            </div>

                            {/* Branch Programs */}
                            <div className="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-xl p-6">
                                <div className="text-3xl mb-4">🌟</div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-2">Branch Programs</h3>
                                <p className="text-gray-600 dark:text-gray-300 mb-3">Malang, Sidoarjo, Nganjuk</p>
                                <ul className="text-sm text-gray-600 dark:text-gray-300 space-y-1">
                                    <li>• Cilukba (Pre-school)</li>
                                    <li>• Hompimpa (Elementary)</li>
                                    <li>• Hip Hip Hurray (Junior High)</li>
                                    <li>• Insight Out (Senior High)</li>
                                </ul>
                                <div className="mt-4 text-sm font-semibold text-orange-600 dark:text-orange-400">
                                    Commission: 15-22%
                                </div>
                            </div>
                        </div>
                    </section>

                    {/* Features Section */}
                    <section className="mb-16">
                        <h2 className="text-4xl font-bold text-center text-gray-900 dark:text-white mb-12">
                            ⚡ Affiliate Features
                        </h2>
                        
                        <div className="grid md:grid-cols-3 gap-8">
                            <div className="text-center">
                                <div className="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">📊</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Real-time Analytics</h3>
                                <p className="text-gray-600 dark:text-gray-300">Track clicks, conversions, and earnings in real-time with detailed reporting</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🎨</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Marketing Materials</h3>
                                <p className="text-gray-600 dark:text-gray-300">Access banners, captions, posters, videos, and landing pages</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">💰</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Flexible Payouts</h3>
                                <p className="text-gray-600 dark:text-gray-300">Bank transfer payouts with customizable minimum thresholds</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-16 h-16 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🔗</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Custom Links & QR Codes</h3>
                                <p className="text-gray-600 dark:text-gray-300">Generate unique affiliate links and QR codes for offline promotion</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🛡️</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Anti-fraud Protection</h3>
                                <p className="text-gray-600 dark:text-gray-300">Advanced tracking with duplicate detection and manual review</p>
                            </div>
                            
                            <div className="text-center">
                                <div className="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <span className="text-2xl">🎖️</span>
                                </div>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-3">Tier System</h3>
                                <p className="text-gray-600 dark:text-gray-300">Bronze to Platinum tiers with increasing commission rates</p>
                            </div>
                        </div>
                    </section>

                    {/* CTA Section */}
                    <section className="text-center bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-white">
                        <h2 className="text-4xl font-bold mb-6">Ready to Start Earning?</h2>
                        <p className="text-xl mb-8 max-w-2xl mx-auto">
                            Join hundreds of successful affiliates promoting English Booster programs across Indonesia
                        </p>
                        {!auth.user && (
                            <Link
                                href={route('register')}
                                className="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors text-lg font-semibold"
                            >
                                🚀 Start Your Affiliate Journey
                            </Link>
                        )}
                        {auth.user && (
                            <Link
                                href={route('affiliate.dashboard')}
                                className="inline-block px-8 py-4 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors text-lg font-semibold"
                            >
                                📊 Go to Dashboard
                            </Link>
                        )}
                    </section>
                </main>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12">
                    <div className="max-w-7xl mx-auto px-6 text-center">
                        <div className="flex items-center justify-center space-x-2 mb-4">
                            <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold">EB</span>
                            </div>
                            <span className="text-lg font-bold">English Booster</span>
                        </div>
                        <p className="text-gray-400 mb-4">
                            Empowering English learning across Indonesia through our affiliate network
                        </p>
                        <div className="text-sm text-gray-500">
                            Built with ❤️ using Laravel & React • Affiliate Marketing System
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}