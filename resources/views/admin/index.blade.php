@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Add New Agent</h3>
                    <p class="mt-1 text-sm text-gray-500">Use this form to add a new agent that doesn't already exist.</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">

                    <form id="new-agent-form" action="{{ route('agents.store') }}" method="post" class="w-full">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 form-control">
                                <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                <input type="text" name="first_name" id="first-name" autocomplete="first-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            </div>

                            <div class="col-span-6 sm:col-span-3 form-control">
                                <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                <input type="text" name="last_name" id="last-name" autocomplete="last-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-4 form-control">
                                <label for="email-address" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" name="email" id="email-address" autocomplete="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-4 form-control">
                                <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="text" name="phone" id="phone-number" autocomplete="phone-number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3 form-control">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Mexico">Mexico</option>
                                </select>
                            </div>

                            <div class="col-span-6 form-control">
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <input type="text" name="address" id="address" autocomplete="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2 form-control">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" id="city" autocomplete="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 form-control">
                                <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                                <input type="text" name="region" id="region" autocomplete="region" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2 form-control">
                                <label for="postcode" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                <input type="text" name="postcode" id="postcode" autocomplete="postcode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Assign Agent To Property</h3>
                    <p class="mt-1 text-sm text-gray-500">Assign an agent to a property by selecting an agent, searching for a property, and choosing which type of agent they will be for the property</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">

                    <form id="assign-agent-form" action="{{ route('agent-properties.store') }}" method="post" class="w-full">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 form-control">
                                <label for="agent" class="block text-sm font-medium text-gray-700">Agent</label>
                                <select id="agent" name="agent" autocomplete="agent" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 form-control">
                                <label for="property" class="block text-sm font-medium text-gray-700">Property</label>
                                <select id="property" name="property" autocomplete="property" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">

                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 space-y-2 form-control">
                                <label for="type" class="block text-sm font-medium text-gray-700">Agent Type</label>
                                <div class="flex items-center">
                                    <input id="seller" name="type" type="radio" value="seller" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500" required>
                                    <label for="seller" class="ml-3 block text-sm font-medium text-gray-700">Seller</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="coordinator" name="type" type="radio" value="coordinator" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="coordinator" class="ml-3 block text-sm font-medium text-gray-700">Coordinator</label>
                                </div>
                            </div>

                        </div>

                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-4">
                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        var agentsApiEndpoint = '{{ route('agents.index') }}';
        var propertiesApiEndpoint = '{{ route('properties.index') }}';
    </script>
    @vite('resources/js/admin/dashboard.js')
@endpush
