<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import SelectClassroom from '@/Components/SelectClassroom.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { vMaska } from 'maska'
import { computed, ref } from 'vue'
import { alert } from '@/DataShare/store.js'

const props = defineProps({
    classrooms: Object
})

const toast = computed(() => usePage().props.alert)

const placeholderText = ref('')

const form = useForm({
    name: '',
    dob: '',
    gender: '',
    email: '',
    contact:'',
    address: '',
    district: '',
    city: '',
    zipcode: '',
    classroom_id: ''
})



const fillAddress = async () => {
    if (form.zipcode.length === 8) {
        placeholderText.value = 'Buscando resultados...'
        const resp = await axios.get(
            `https://viacep.com.br/ws/${form.zipcode}/json/`
        )
        if (resp.data.erro) {
            alert.id = Math.floor(Math.random() * 10000)
            alert.type = 'warning'
            alert.title = 'Erro no CEP'
            alert.message = `O CEP ${form.zipcode} não retornou nenhum endereço`
            placeholderText.value = ''
        } else {
            placeholderText.value = ''
            form.address = resp.data.logradouro
            form.district = resp.data.bairro
            form.city = resp.data.localidade
        }
    }
}

const onlyNumbers = (e) => {
    if (!/^[0-9]|(Backspace|Tab|ArrowLeft|ArrowRight|Delete)$/.test(e.key)) {
        e.preventDefault()
    }
}

const submit = () => {
    form.post(route('alunos.store'), {
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
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <form @submit.prevent="submit">
                        <div class="space-y-8">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2
                                    class="text-base font-semibold leading-7 text-gray-900">
                                    Informações do Estudante
                                </h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Ao preencher o campo de CEP com um CEP
                                    válido os demais campos de endereço serão
                                    automaticamente preenchidos
                                </p>

                                <div
                                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-10">
                                    <div class="sm:col-span-3">
                                        <div>
                                            <InputLabel
                                                for="name"
                                                value="Nome Completo" />

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

                                    <div class="sm:col-span-3">
                                        <div>
                                            <InputLabel
                                                for="email"
                                                value="E-mail" />

                                            <TextInput
                                                id="email"
                                                v-model="form.email"
                                                autocomplete="email"
                                                class="mt-2 block w-full"
                                                type="email" />

                                            <InputError
                                                :message="form.errors.email"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div>
                                            <InputLabel
                                                for="contact"
                                                value="Celular" />

                                            <TextInput
                                                id="contact"
                                                v-model="form.contact"
                                                @keydown="onlyNumbers"
                                                v-maska data-maska="(##) #####-####"
                                                autocomplete="contact"
                                                class="mt-2 block w-full"
                                                type="text" />

                                            <InputError
                                                :message="form.errors.contact"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div>
                                            <InputLabel
                                                for="dob"
                                                value="Data de Nascimento" />

                                            <TextInput
                                                id="dob"
                                                v-model="form.dob"
                                                autocomplete="dob"
                                                class="mt-2 block w-full"
                                                type="date" />

                                            <InputError
                                                :message="form.errors.dob"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div>
                                            <InputLabel
                                                for="zipcode"
                                                value="CEP" />

                                            <TextInput
                                                id="zipcode"
                                                v-model="form.zipcode"
                                                autocomplete="zipcode"
                                                class="mt-2 block w-full"
                                                maxlength="8"
                                                placeholder="Somente números"
                                                type="text"
                                                @blur="fillAddress"
                                                @keydown="onlyNumbers" />

                                            <InputError
                                                :message="form.errors.zipcode"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-4">
                                        <div>
                                            <InputLabel
                                                for="address"
                                                value="Endereço" />

                                            <TextInput
                                                id="address"
                                                v-model="form.address"
                                                :placeholder="placeholderText"
                                                autocomplete="address"
                                                class="mt-2 block w-full"
                                                type="text" />

                                            <InputError
                                                :message="form.errors.address"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div>
                                            <InputLabel
                                                for="district"
                                                value="Bairro" />

                                            <TextInput
                                                id="district"
                                                v-model="form.district"
                                                :placeholder="placeholderText"
                                                autocomplete="district"
                                                class="mt-2 block w-full"
                                                type="text" />

                                            <InputError
                                                :message="form.errors.district"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div>
                                            <InputLabel
                                                for="city"
                                                value="Cidade" />

                                            <TextInput
                                                id="city"
                                                v-model="form.city"
                                                :placeholder="placeholderText"
                                                autocomplete="city"
                                                class="mt-2 block w-full"
                                                type="text" />

                                            <InputError
                                                :message="form.errors.city"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <div>
                                            <InputLabel value="Gênero" />

                                            <fieldset class="border mt-2 border-gray-300 px-2 py-2 rounded-lg">
                                                <legend class="sr-only">Notification method</legend>
                                                <div class="space-y-4 sm:flex sm:items-center sm:space-x-6 sm:space-y-0">
                                                    <div class="flex items-center">
                                                        <input id="f" name="gender" type="radio" v-model="form.gender" value='f' class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                        <label for="f" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Feminino</label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="m" name="gender" type="radio" v-model="form.gender" value='m' class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                                        <label for="m" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Masculino</label>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <InputError
                                                :message="form.errors.gender"
                                                class="mt-2" />
                                        </div>
                                    </div>

                                    <div class='sm:col-span-3'>
                                        <SelectClassroom :classrooms='classrooms' v-model='form.classroom_id' />
                                        <InputError :message='form.errors.classroom' class='mt-2' />
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
