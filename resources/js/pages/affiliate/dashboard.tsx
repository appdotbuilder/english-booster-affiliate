import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Commission {
    id: number;
    commission_amount: string;
    status: string;
    created_at: string;
    order: {
        order_number: string;
        customer_name: string;
        total_amount: string;
        affiliate_program: {
            name: string;
            type: string;
        };
    };
}

interface AffiliateLink {
    id: number;
    link_code: string;
    clicks: number;
    conversions: number;
    affiliate_program: {
        name: string;
        type: string;
    };
    campaign: string;
}

interface Stats {
    total_clicks: number;
    total_conversions: number;
    total_earnings: string;
    pending_earnings: string;
    paid_earnings: string;
    conversion_rate: number;
}

interface Affiliate {
    id: number;
    affiliate_code: string;
    full_name: string;
    status: string;
    tier: string;
    total_commissions_earned: string;
    total_commissions_paid: string;
}

interface Props {
    affiliate: Affiliate | null;
    stats: Stats;
    recent_commissions: Commission[];
    affiliate_links: AffiliateLink[];
    [key: string]: unknown;
}

export default function AffiliateDashboard({ affiliate, stats, recent_commissions, affiliate_links }: Props) {
    if (!affiliate) {
        return (
            <AppShell>
                <Head title="Affiliate Registration" />
                <div className="p-6">
                    <div className="max-w-2xl mx-auto">
                        <div className="bg-white rounded-xl shadow-sm border p-8 text-center">
                            <div className="text-6xl mb-6">🚀</div>
                            <h1 className="text-2xl font-bold text-gray-900 mb-4">
                                Welcome to English Booster Affiliate Program
                            </h1>
                            <p className="text-gray-600 mb-8">
                                Start earning commissions by promoting English Booster programs. 
                                Complete your affiliate registration to get started.
                            </p>
                            <a
                                href="/affiliate/create"
                                className="inline-block px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-semibold"
                            >
                                Complete Registration
                            </a>
                        </div>
                    </div>
                </div>
            </AppShell>
        );
    }

    const formatCurrency = (amount: string) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(parseFloat(amount));
    };

    const getStatusBadge = (status: string) => {
        const colors = {
            pending: 'bg-yellow-100 text-yellow-800',
            active: 'bg-green-100 text-green-800',
            inactive: 'bg-gray-100 text-gray-800',
            suspended: 'bg-red-100 text-red-800',
        };
        return colors[status as keyof typeof colors] || 'bg-gray-100 text-gray-800';
    };

    const getTierBadge = (tier: string) => {
        const colors = {
            bronze: 'bg-amber-100 text-amber-800',
            silver: 'bg-gray-100 text-gray-800',
            gold: 'bg-yellow-100 text-yellow-800',
            platinum: 'bg-purple-100 text-purple-800',
        };
        return colors[tier as keyof typeof colors] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Affiliate Dashboard" />
            <div className="p-6">
                {/* Header */}
                <div className="mb-8">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-3xl font-bold text-gray-900">
                                📊 Affiliate Dashboard
                            </h1>
                            <p className="text-gray-600 mt-1">
                                Welcome back, {affiliate.full_name}!
                            </p>
                        </div>
                        <div className="text-right">
                            <div className="flex items-center space-x-3">
                                <span className={`px-3 py-1 rounded-full text-sm font-medium ${getStatusBadge(affiliate.status)}`}>
                                    {affiliate.status.charAt(0).toUpperCase() + affiliate.status.slice(1)}
                                </span>
                                <span className={`px-3 py-1 rounded-full text-sm font-medium ${getTierBadge(affiliate.tier)}`}>
                                    {affiliate.tier.charAt(0).toUpperCase() + affiliate.tier.slice(1)} Tier
                                </span>
                            </div>
                            <div className="text-sm text-gray-500 mt-1">
                                Code: {affiliate.affiliate_code}
                            </div>
                        </div>
                    </div>
                </div>

                {affiliate.status === 'pending' && (
                    <div className="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div className="flex">
                            <div className="flex-shrink-0">
                                <span className="text-yellow-400 text-xl">⏳</span>
                            </div>
                            <div className="ml-3">
                                <h3 className="text-sm font-medium text-yellow-800">
                                    Account Pending Approval
                                </h3>
                                <p className="mt-1 text-sm text-yellow-700">
                                    Your affiliate account is pending approval. You'll receive an email once your account is activated.
                                </p>
                            </div>
                        </div>
                    </div>
                )}

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div className="bg-white rounded-xl shadow-sm border p-6">
                        <div className="flex items-center">
                            <div className="p-3 bg-blue-100 rounded-lg">
                                <span className="text-xl">👆</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Total Clicks</p>
                                <p className="text-2xl font-bold text-gray-900">
                                    {stats.total_clicks.toLocaleString()}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl shadow-sm border p-6">
                        <div className="flex items-center">
                            <div className="p-3 bg-green-100 rounded-lg">
                                <span className="text-xl">✅</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Conversions</p>
                                <p className="text-2xl font-bold text-gray-900">
                                    {stats.total_conversions}
                                </p>
                                <p className="text-xs text-green-600">
                                    {stats.conversion_rate}% rate
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl shadow-sm border p-6">
                        <div className="flex items-center">
                            <div className="p-3 bg-yellow-100 rounded-lg">
                                <span className="text-xl">💰</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Pending Earnings</p>
                                <p className="text-2xl font-bold text-gray-900">
                                    {formatCurrency(stats.pending_earnings)}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-white rounded-xl shadow-sm border p-6">
                        <div className="flex items-center">
                            <div className="p-3 bg-purple-100 rounded-lg">
                                <span className="text-xl">💎</span>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Total Earned</p>
                                <p className="text-2xl font-bold text-gray-900">
                                    {formatCurrency(stats.total_earnings)}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid lg:grid-cols-2 gap-8">
                    {/* Recent Commissions */}
                    <div className="bg-white rounded-xl shadow-sm border">
                        <div className="p-6 border-b border-gray-200">
                            <div className="flex items-center justify-between">
                                <h2 className="text-xl font-bold text-gray-900">Recent Commissions</h2>
                                <a
                                    href="/affiliate/commissions"
                                    className="text-blue-600 hover:text-blue-700 text-sm font-medium"
                                >
                                    View All →
                                </a>
                            </div>
                        </div>
                        <div className="p-6">
                            {recent_commissions.length > 0 ? (
                                <div className="space-y-4">
                                    {recent_commissions.map((commission) => (
                                        <div key={commission.id} className="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                            <div className="flex-1">
                                                <p className="font-medium text-gray-900">
                                                    {commission.order.affiliate_program.name}
                                                </p>
                                                <p className="text-sm text-gray-600">
                                                    Order #{commission.order.order_number} • {commission.order.customer_name}
                                                </p>
                                                <p className="text-xs text-gray-500">
                                                    {new Date(commission.created_at).toLocaleDateString()}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="font-bold text-gray-900">
                                                    {formatCurrency(commission.commission_amount)}
                                                </p>
                                                <span className={`inline-block px-2 py-1 text-xs rounded-full ${
                                                    commission.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                                    commission.status === 'approved' ? 'bg-green-100 text-green-800' :
                                                    commission.status === 'paid' ? 'bg-blue-100 text-blue-800' :
                                                    'bg-gray-100 text-gray-800'
                                                }`}>
                                                    {commission.status}
                                                </span>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8">
                                    <span className="text-4xl">📊</span>
                                    <p className="text-gray-500 mt-2">No commissions yet</p>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Affiliate Links Performance */}
                    <div className="bg-white rounded-xl shadow-sm border">
                        <div className="p-6 border-b border-gray-200">
                            <div className="flex items-center justify-between">
                                <h2 className="text-xl font-bold text-gray-900">Top Performing Links</h2>
                                <a
                                    href="/affiliate/links"
                                    className="text-blue-600 hover:text-blue-700 text-sm font-medium"
                                >
                                    Manage Links →
                                </a>
                            </div>
                        </div>
                        <div className="p-6">
                            {affiliate_links.length > 0 ? (
                                <div className="space-y-4">
                                    {affiliate_links.slice(0, 5).map((link) => (
                                        <div key={link.id} className="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                                            <div className="flex-1">
                                                <p className="font-medium text-gray-900">
                                                    {link.affiliate_program.name}
                                                </p>
                                                <p className="text-sm text-gray-600">
                                                    Campaign: {link.campaign}
                                                </p>
                                                <p className="text-xs text-gray-500">
                                                    Code: {link.link_code}
                                                </p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-sm text-gray-900">
                                                    {link.clicks} clicks
                                                </p>
                                                <p className="text-sm text-green-600">
                                                    {link.conversions} conversions
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8">
                                    <span className="text-4xl">🔗</span>
                                    <p className="text-gray-500 mt-2">No affiliate links yet</p>
                                    <a
                                        href="/affiliate/links"
                                        className="text-blue-600 hover:text-blue-700 text-sm font-medium mt-2 inline-block"
                                    >
                                        Create your first link →
                                    </a>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-8">
                    <h2 className="text-2xl font-bold text-gray-900 mb-6 text-center">
                        🚀 Quick Actions
                    </h2>
                    <div className="grid md:grid-cols-4 gap-4">
                        <a
                            href="/affiliate/links"
                            className="flex flex-col items-center p-6 bg-white rounded-lg hover:shadow-md transition-shadow"
                        >
                            <span className="text-3xl mb-2">🔗</span>
                            <span className="font-medium text-gray-900">Generate Links</span>
                        </a>
                        <a
                            href="/affiliate/materials"
                            className="flex flex-col items-center p-6 bg-white rounded-lg hover:shadow-md transition-shadow"
                        >
                            <span className="text-3xl mb-2">🎨</span>
                            <span className="font-medium text-gray-900">Marketing Materials</span>
                        </a>
                        <a
                            href="/affiliate/commissions"
                            className="flex flex-col items-center p-6 bg-white rounded-lg hover:shadow-md transition-shadow"
                        >
                            <span className="text-3xl mb-2">📊</span>
                            <span className="font-medium text-gray-900">View Commissions</span>
                        </a>
                        <a
                            href="/affiliate/payouts"
                            className="flex flex-col items-center p-6 bg-white rounded-lg hover:shadow-md transition-shadow"
                        >
                            <span className="text-3xl mb-2">💰</span>
                            <span className="font-medium text-gray-900">Request Payout</span>
                        </a>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}