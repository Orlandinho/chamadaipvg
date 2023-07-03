<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    pages: Object,
})

const maxlinks = computed(() => {
    let numShown = props.pages.last_page > 5 ? 5 : props.pages.last_page
    numShown = Math.min(numShown, props.pages.last_page)
    let first = props.pages.current_page - Math.floor(numShown / 2)
    first = Math.max(first, 1)
    first = Math.min(first, props.pages.last_page - numShown + 1)
    return [...Array(numShown)].map((k, i) => i + first)
})

const pluralName = computed(() => (props.pages.total > 1 ? 'nomes' : 'nome'))

const informativeMessage = computed(
    () =>
        `Exibindo de ${props.pages.from} a ${props.pages.to} de um total de ${props.pages.total} ${pluralName.value}`
)
</script>

<template>
    <div class="flex items-center justify-between bg-gray-100 py-2 px-1">
        <div class="flex flex-1 justify-between sm:hidden">
            <Link
                :disabled="pages.current_page <= 1"
                :href="
                    route('alunos.index', { page: pages.current_page - 1 })
                "
                as="button"
                class="relative inline-flex items-center rounded-md border border-red-500 bg-white px-4 py-2 text-sm font-medium text-zinc-800 hover:bg-red-50"
                type="button">
                Anterior
            </Link>
            <Link
                :disabled="pages.current_page === pages.last_page"
                :href="
                    route('alunos.index', { page: pages.current_page + 1 })
                "
                as="button"
                class="relative inline-flex items-center rounded-md border border-zinc-500 bg-zinc-900 px-4 py-2 text-sm font-medium text-zinc-300 hover:bg-zinc-50"
                type="button">
                Próximo
            </Link>
        </div>
        <div
            class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            <div>
                <p
                    v-if="pages.total > 0"
                    class="text-sm text-zinc-700">
                    <span class="font-medium">{{ informativeMessage }}</span>
                </p>
                <p
                    v-else
                    class="text-sm text-zinc-700">
                    <span class="font-medium">Nenhum resultado</span>
                </p>
            </div>
            <div v-show="pages.last_page > 1">
                <nav
                    aria-label="Pagination"
                    class="isolate inline-flex -space-x-px rounded-md shadow-sm">
                    <Link
                        :class="
                            pages.current_page > 1
                                ? 'hover:bg-zinc-400 hover:text-white text-zinc-600'
                                : 'text-zinc-400'
                        "
                        :disabled="pages.current_page <= 1"
                        :href="
                            route('alunos.index', {
                                page: pages.current_page - 1,
                            })
                        "
                        as="button"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 bg-white ring-1 ring-inset ring-zinc-500 focus:z-20 focus:outline-offset-0"
                        preserve-scroll
                        type="button">
                        <span class="sr-only">Previous</span>
                        <ChevronLeftIcon
                            aria-hidden="true"
                            class="h-5 w-5" />
                    </Link>
                    <template
                        v-for="(page, index) in maxlinks"
                        :key="index">
                        <Link
                            :class="
                                pages.current_page === page
                                    ? 'z-10 bg-zinc-500 text-white'
                                    : 'bg-white text-zinc-600'
                            "
                            :href="route('alunos.index', { page: page })"
                            aria-current="page"
                            class="relative z-10 inline-flex items-center px-4 py-2 text-sm font-medium focus:z-20 border border-zinc-500 hover:bg-zinc-400 hover:text-white"
                            preserve-scroll
                            v-html="page" />
                    </template>
                    <Link
                        :class="
                            pages.current_page !== pages.last_page
                                ? 'hover:bg-zinc-400 hover:text-white text-zinc-600'
                                : 'text-zinc-400'
                        "
                        :disabled="pages.current_page === pages.last_page"
                        :href="
                            route('alunos.index', {
                                page: pages.current_page + 1,
                            })
                        "
                        as="button"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 bg-white ring-1 ring-inset ring-zinc-500 focus:z-20 focus:outline-offset-0"
                        preserve-scroll
                        type="button">
                        <span class="sr-only">Next</span>
                        <ChevronRightIcon
                            aria-hidden="true"
                            class="h-5 w-5" />
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>
