<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import DeleteDialog from '@/Components/DeleteDialog.vue'
import Pagination from '@/Components/Pagination.vue'
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid/index.js'
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { alert } from '@/DataShare/store.js'

const modalDialog = ref(null)

const toast = computed(() => usePage().props.alert)

const props = defineProps({
    classroom: Object,
    students: Object
})

const form = useForm({})

const destroy = (id) => {
    form.delete(route('alunos.destroy', id), {
        onSuccess: () => {
            alert.id = Math.floor(Math.random() * 10000)
            alert.type = toast.value.type
            alert.title = toast.value.title
            alert.message = toast.value.message
        }
    })
}
</script>

<template>
    <Head :title="classroom.name" />

    <AuthenticatedLayout>
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1
                                        class="text-base font-semibold leading-6 text-gray-900">
                                        {{ classroom.name }}
                                    </h1>
                                    <p class="mt-2 text-sm text-gray-700">
                                        Lista dos alunos da classe {{ classroom.name}}
                                    </p>
                                </div>
                                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                                    <Link
                                        :href="route('alunos.create')"
                                        class="block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600"
                                        type="button">
                                        Novo Estudante
                                    </Link>
                                </div>
                            </div>
                            <div class="mt-4 flow-root">
                                <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8 max-h-96 overflow-y-auto">
                                    <div
                                        class="inline-block min-w-full py-2 align-middle">
                                        <table class="min-w-full border-separate border-spacing-0">
                                            <thead>
                                            <tr>
                                                <th
                                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
                                                    scope="col">
                                                    Nome
                                                </th>
                                                <th
                                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold backdrop-blur backdrop-filter sm:table-cell"
                                                    scope="col">
                                                    E-mail
                                                </th>
                                                <th
                                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold backdrop-blur backdrop-filter lg:table-cell"
                                                    scope="col">
                                                    Data de Nascimento
                                                </th>
                                                <th
                                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold backdrop-blur backdrop-filter"
                                                    scope="col">
                                                    Idade
                                                </th>
                                                <th
                                                    class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-3 pr-4 text-left text-sm font-semibold backdrop-blur backdrop-filter sm:pr-6 lg:pr-8"
                                                    scope="col">
                                                    Ações
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr
                                                v-for="(
                                                        student, index
                                                    ) in students"
                                                :key="index"
                                                class="even:bg-zinc-100 hover:bg-zinc-200">
                                                <td
                                                    :class="[
                                                            student.id !==
                                                            student.length - 1
                                                                ? 'border-b border-gray-200'
                                                                : '',
                                                            'whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8',
                                                        ]">
                                                    <Link
                                                        :href="
                                                                route(
                                                                    'alunos.show',
                                                                    student.slug
                                                                )
                                                            "
                                                        class="hover:underline hover:text-red-500">
                                                        {{ student.name }}
                                                    </Link>
                                                </td>
                                                <td
                                                    :class="[
                                                            student.id !==
                                                            student.length - 1
                                                                ? 'border-b border-gray-200'
                                                                : '',
                                                            'whitespace-nowrap hidden px-3 py-4 text-sm text-gray-500 sm:table-cell',
                                                        ]">
                                                    {{ student.email }}
                                                </td>
                                                <td
                                                    :class="[
                                                            student.id !==
                                                            student.length - 1
                                                                ? 'border-b border-gray-200'
                                                                : '',
                                                            'whitespace-nowrap hidden px-3 py-4 text-sm text-gray-500 lg:table-cell',
                                                        ]">
                                                    {{ student.birthday }}
                                                </td>
                                                <td
                                                    :class="[
                                                            student.id !==
                                                            student.length - 1
                                                                ? 'border-b border-gray-200'
                                                                : '',
                                                            'whitespace-nowrap px-3 py-4 text-sm text-gray-500',
                                                        ]">
                                                    {{ student.age }}
                                                </td>
                                                <td
                                                    :class="[
                                                            student.id !==
                                                            student.length - 1
                                                                ? 'border-b border-gray-200'
                                                                : '',
                                                            'relative whitespace-nowrap py-4 pr-4 pl-3 text-right text-sm font-medium sm:pr-8 lg:pr-8',
                                                        ]">
                                                    <div class='flex space-x-2'>
                                                        <Link
                                                            :href="route('alunos.edit', student.slug)"
                                                        >
                                                            <PencilSquareIcon
                                                                class='h-5 w-5 text-green-500 hover:text-green-400' />
                                                        </Link
                                                        >
                                                        <button @click="modalDialog.openModal(student)">
                                                            <TrashIcon class="h-5 w-5 text-red-500 hover:text-red-400"/>
                                                        </button>
                                                    </div>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!--                <Pagination :pages='students.meta' class='mt-4'/>-->
            </div>
        </div>
    </AuthenticatedLayout>
    <DeleteDialog ref='modalDialog' @confirmed='(student) => destroy(student.id)' />
</template>
