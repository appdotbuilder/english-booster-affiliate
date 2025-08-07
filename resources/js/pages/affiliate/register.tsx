import React from 'react';
import { Head, useForm } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import InputError from '@/components/input-error';

export default function AffiliateRegister() {
    const { data, setData, post, processing, errors } = useForm({
        full_name: '',
        phone: '',
        bank_name: '',
        bank_account_number: '',
        bank_account_holder: '',
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post('/affiliate');
    };

    const banks = [
        'BCA (Bank Central Asia)',
        'BRI (Bank Rakyat Indonesia)', 
        'BNI (Bank Negara Indonesia)',
        'BTN (Bank Tabungan Negara)',
        'Mandiri',
        'CIMB Niaga',
        'Danamon',
        'Permata Bank',
        'OCBC NISP',
        'Maybank Indonesia',
        'Bank Syariah Indonesia (BSI)',
        'Jenius',
        'TMRW by UOB',
        'Other',
    ];

    return (
        <AppShell>
            <Head title="Affiliate Registration" />
            <div className="p-6">
                <div className="max-w-2xl mx-auto">
                    {/* Header */}
                    <div className="text-center mb-8">
                        <div className="text-6xl mb-4">🚀</div>
                        <h1 className="text-3xl font-bold text-gray-900 mb-2">
                            Join English Booster Affiliate Program
                        </h1>
                        <p className="text-gray-600">
                            Complete your registration to start earning commissions by promoting our English programs
                        </p>
                    </div>

                    {/* Benefits */}
                    <div className="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-8">
                        <h2 className="text-xl font-bold text-gray-900 mb-4">
                            🎯 Why Become Our Affiliate?
                        </h2>
                        <div className="grid md:grid-cols-2 gap-4">
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Commission rates up to 30%</span>
                            </div>
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Real-time tracking & analytics</span>
                            </div>
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Ready-to-use marketing materials</span>
                            </div>
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Multiple program types & locations</span>
                            </div>
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Monthly payouts via bank transfer</span>
                            </div>
                            <div className="flex items-start">
                                <span className="text-green-500 mr-2">✅</span>
                                <span className="text-gray-700">Tiered rewards system</span>
                            </div>
                        </div>
                    </div>

                    {/* Registration Form */}
                    <div className="bg-white rounded-xl shadow-sm border p-8">
                        <h2 className="text-2xl font-bold text-gray-900 mb-6">
                            Complete Your Registration
                        </h2>
                        
                        <form onSubmit={handleSubmit} className="space-y-6">
                            {/* Full Name */}
                            <div>
                                <label htmlFor="full_name" className="block text-sm font-medium text-gray-700 mb-2">
                                    Full Name *
                                </label>
                                <input
                                    type="text"
                                    id="full_name"
                                    value={data.full_name}
                                    onChange={(e) => setData('full_name', e.target.value)}
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Enter your full name"
                                    required
                                />
                                <InputError message={errors.full_name} className="mt-1" />
                            </div>

                            {/* Phone */}
                            <div>
                                <label htmlFor="phone" className="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number *
                                </label>
                                <input
                                    type="tel"
                                    id="phone"
                                    value={data.phone}
                                    onChange={(e) => setData('phone', e.target.value)}
                                    className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="e.g., 0812-3456-7890"
                                    required
                                />
                                <InputError message={errors.phone} className="mt-1" />
                            </div>

                            {/* Bank Information */}
                            <div className="border-t pt-6">
                                <h3 className="text-lg font-semibold text-gray-900 mb-4">
                                    💳 Bank Account Information
                                </h3>
                                <p className="text-gray-600 text-sm mb-4">
                                    This information is required for commission payouts
                                </p>

                                {/* Bank Name */}
                                <div className="mb-4">
                                    <label htmlFor="bank_name" className="block text-sm font-medium text-gray-700 mb-2">
                                        Bank Name *
                                    </label>
                                    <select
                                        id="bank_name"
                                        value={data.bank_name}
                                        onChange={(e) => setData('bank_name', e.target.value)}
                                        className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required
                                    >
                                        <option value="">Select your bank</option>
                                        {banks.map((bank) => (
                                            <option key={bank} value={bank}>
                                                {bank}
                                            </option>
                                        ))}
                                    </select>
                                    <InputError message={errors.bank_name} className="mt-1" />
                                </div>

                                {/* Account Number */}
                                <div className="mb-4">
                                    <label htmlFor="bank_account_number" className="block text-sm font-medium text-gray-700 mb-2">
                                        Account Number *
                                    </label>
                                    <input
                                        type="text"
                                        id="bank_account_number"
                                        value={data.bank_account_number}
                                        onChange={(e) => setData('bank_account_number', e.target.value)}
                                        className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Enter your account number"
                                        required
                                    />
                                    <InputError message={errors.bank_account_number} className="mt-1" />
                                </div>

                                {/* Account Holder */}
                                <div>
                                    <label htmlFor="bank_account_holder" className="block text-sm font-medium text-gray-700 mb-2">
                                        Account Holder Name *
                                    </label>
                                    <input
                                        type="text"
                                        id="bank_account_holder"
                                        value={data.bank_account_holder}
                                        onChange={(e) => setData('bank_account_holder', e.target.value)}
                                        className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Name as appears on bank account"
                                        required
                                    />
                                    <InputError message={errors.bank_account_holder} className="mt-1" />
                                    <p className="text-sm text-gray-500 mt-1">
                                        Must match the name on your bank account exactly
                                    </p>
                                </div>
                            </div>

                            {/* Terms */}
                            <div className="bg-gray-50 rounded-lg p-4">
                                <h4 className="font-medium text-gray-900 mb-2">📋 Terms & Conditions</h4>
                                <ul className="text-sm text-gray-600 space-y-1">
                                    <li>• Minimum payout threshold: IDR 100,000</li>
                                    <li>• Commissions are paid monthly via bank transfer</li>
                                    <li>• Self-referrals and fraudulent activities are prohibited</li>
                                    <li>• Account approval may take 1-3 business days</li>
                                    <li>• Commission rates vary by program type and affiliate tier</li>
                                </ul>
                            </div>

                            {/* Submit Button */}
                            <Button
                                type="submit"
                                disabled={processing}
                                className="w-full py-4 text-lg"
                            >
                                {processing ? (
                                    <>
                                        <span className="animate-spin mr-2">⏳</span>
                                        Processing...
                                    </>
                                ) : (
                                    <>
                                        🚀 Submit Registration
                                    </>
                                )}
                            </Button>
                        </form>
                    </div>

                    {/* Contact Info */}
                    <div className="mt-8 text-center">
                        <p className="text-gray-600 mb-2">
                            Questions about the affiliate program?
                        </p>
                        <div className="flex justify-center space-x-6 text-sm">
                            <div className="flex items-center">
                                <span className="mr-2">📞</span>
                                <span>0822-3105-0500</span>
                            </div>
                            <div className="flex items-center">
                                <span className="mr-2">📱</span>
                                <span>@kampunginggrisbooster</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}