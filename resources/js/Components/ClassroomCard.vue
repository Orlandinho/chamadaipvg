<script setup>
import { AcademicCapIcon, UserGroupIcon, TrashIcon, PencilSquareIcon } from '@heroicons/vue/20/solid/index.js'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    classroom: Object
})

const emit = defineEmits([
    'deleteClass'
])

const clicked = () => {
    emit('deleteClass')
}


</script>

<template>
    <div class="w-56 h-88">
        <h2 class="sr-only">Classe</h2>
        <div
            class="rounded-lg bg-gray-50 shadow-sm border-2"
            :class="classroom.borderColor">
            <div class="text-center">
                <div class="pt-6">
                    <div class="text-base flex justify-between px-5 font-semibold leading-6">
                        <Link :href="route('classes.edit', classroom.slug)">
                            <PencilSquareIcon
                                aria-hidden="true"
                                class="h-6 w-5"
                                :class="classroom.textColor"
                            />
                        </Link>
                        <Link :href="route('classes.show', classroom.slug)">
                            {{ classroom.name }}
                        </Link>
                        <button>
                            <TrashIcon
                                aria-hidden="true"
                                class="h-6 w-5"
                                :class="classroom.textColor"
                                @click="clicked"
                            />
                        </button>
                    </div>
                </div>
                <div
                    class="mt-6 flex w-full flex-none gap-x-4 border-t-2 px-5 pt-6"
                    :class="classroom.borderColor">
                    <div class="flex-none">
                        <span class="sr-only">Client</span>
                        <AcademicCapIcon
                            aria-hidden="true"
                            class="h-6 w-5"
                            :class="classroom.textColor"
                        />
                    </div>
                    <div class="text-sm font-medium leading-6 text-gray-900">
                        Professores:
                    </div>
                </div>

            </div>
            <div
                :class="classroom.borderColor"
                class="mt-6 flex w-full flex-none gap-x-4 border-t-2 px-5 py-6">
                <div class="flex-none">
                    <span class="sr-only">Client</span>
                    <UserGroupIcon
                        aria-hidden="true"
                        class="h-6 w-5"
                        :class="classroom.textColor"
                    />
                </div>
                <Link
                    :href="route('classes.show', classroom.slug)"
                    class="text-sm font-medium leading-6 text-gray-900"
                >Total de alunos: {{ classroom.students_count }}
                </Link>
            </div>
        </div>
    </div>
</template>
