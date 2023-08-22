<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import RadioColor from '@/Components/RadioColor.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { alert } from '@/DataShare/store.js'

const props = defineProps({
    colors: Object,
    classroom: Object
})

const toast = computed(() => usePage().props.alert)


const form = useForm({
    id: props.classroom.id,
    name: props.classroom.name,
    color: props.classroom.color,
})

const submit = () => {
    form.patch(route('classes.update', props.classroom.id), {
        onSuccess: () => {
            alert.id = Math.floor(Math.random() * 10000)
            alert.type = toast.value.type
            alert.title = toast.value.title
            alert.message = toast.value.message
        },
    })
}
</script>

<template>
    <Head title="Novo Estudante" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div class="space-y-8">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2
                                    class="text-base font-semibold leading-7 text-gray-900">
                                    Criação de Nova Classe
                                </h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Atenção, ao criar uma nova classe deve-se lhe dar um nome único. Uma cor única não é obrigatória, mas ajuda na organização
                                </p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-8">
                                    <div class="sm:col-span-8">
                                        <div>
                                            <InputLabel
                                                for="name"
                                                value="Nome da Classe" />

                                            <TextInput
                                                id="name"
                                                v-model="form.name"
                                                autocomplete="name"
                                                autofocus
                                                class="mt-2 block w-full"
                                                type="text" />

                                            <InputError
                                                :message="form.errors.name"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class='sm:col-span-8'>
                                        <RadioColor checked='checked' v-model="form.color" :colors='colors' />
                                        <InputError
                                            :message="form.errors.color"
                                            class="mt-2" />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <button
                                class="inline-flex items-center px-4 py-1.5 bg-white text-gray-500 border border-gray-500 rounded-md text-sm leading-6 font-semibold hover:text-white hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                type="reset">
                                Limpar
                            </button>

                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Salvar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
