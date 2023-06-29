<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    student: Object,
})

const firstName = computed(() => props.student.name.split(' ')[0])
</script>

<template>
    <Head :title="firstName" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="px-4 sm:px-0">
                            <h3
                                class="text-base font-semibold leading-7 text-gray-900">
                                Informações do/a estudante {{ student.name }}
                            </h3>
                            <p
                                class="mt-1 max-w-2xl text-sm leading-6 text-red-400">
                                Informações pessoais
                            </p>
                        </div>
                        <div class="mt-6">
                            <dl class="grid grid-cols-1 sm:grid-cols-4">
                                <div
                                    class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Data de Nascimento
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.birthday }}
                                    </dd>
                                </div>
                                <div
                                    class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Idade
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.age }}
                                    </dd>
                                </div>
                                <div
                                    class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        E-mail
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.email }}
                                    </dd>
                                </div>
                                <div
                                    class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Contato
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.contact }}
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Endereço
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.address }}
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Bairro
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.district }}
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        Cidade
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.city }}
                                    </dd>
                                </div>
                                <div class="px-4 py-6 sm:col-span-1 sm:px-0">
                                    <dt
                                        class="text-sm font-medium leading-6 text-gray-900">
                                        CEP
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ student.zipcode }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
