<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3'
import ClassroomCard from '@/Components/ClassroomCard.vue'
import { PlusCircleIcon } from '@heroicons/vue/24/outline/index.js'
import ClassroomDelete from '@/Components/ClassroomDelete.vue'
import { alert } from '@/DataShare/store.js'
import { computed, ref } from 'vue'

const props = defineProps({
    classrooms: Object
})

const classroomDialog = ref(null)

const form = useForm({})

const toast = computed(() => usePage().props.alert)

const destroy = (id) => {
    form.delete(route('classes.destroy', id), {
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
    <Head title="Todas as Classes" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="p-6 text-gray-900 grid grid-cols-1 sm:grid-cols-4 gap-y-6">
                        <div class="w-56 h-88">
                            <Link :href="route('classes.create')">
                                <div
                                    class='rounded-lg text-center bg-gray-50 shadow-sm border-2 border-zinc-500 hover:bg-zinc-200'>
                                    <div class='pt-6'>
                                        <div class='text-base font-semibold leading-6'>
                                            Adicionar
                                        </div>
                                    </div>
                                    <div
                                        class='mt-6 flex justify-center px-6 pt-6'>
                                        <PlusCircleIcon
                                            aria-hidden='true'
                                            class='h-7 w-7'
                                        />
                                    </div>
                                    <div
                                        class='mt-6 px-6 py-6'>
                                        <div class='text-base font-semibold leading-6'>
                                            Nova Classe
                                        </div>
                                    </div>
                                </div>
                            </Link>
                        </div>
                        <template
                            v-for="(classroom, index) in classrooms"
                            :key="index">
                            <ClassroomCard @deleteClass="classroomDialog.openModal(classroom)" :classroom="classroom" />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <ClassroomDelete ref='classroomDialog' @confirmed='(classroom) => destroy(classroom.id)' />
</template>
