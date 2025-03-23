<template>
<div class="text-center">
  <ul class="pagination d-inline-flex pagination">
    <li class="page-item bg-body rounded">
      <a v-if="hasPrev(currentPage)"
        @click.prevent="emit('paginate', currentPage - 1)"
        :href="link(currentPage - 1)"
        class="page-link"
        data-no-swup
      >Previous</a>
      <span v-else class="page-link disabled">Previous</span>
    </li>
    <li class="page-item" v-for="(pIndex) in pages">
      <a class="page-link"
        :class="{active: pIndex === currentPage}"
        @click.prevent="emit('paginate', pIndex)"
        :href="link(pIndex)"
        data-no-swup
      >{{ pIndex }}</a>
    </li>
    <li class="page-item">
      <a v-if="hasNext(currentPage)"
        @click.prevent="emit('paginate', currentPage + 1)"
        :href="link(currentPage + 1)"
        class="page-link"
        data-no-swup
      >Next</a>
      <span v-else class="page-link disabled">Next</span>
    </li>
  </ul>
</div>
</template>

<script setup lang="ts">
import type { Pagination } from '~/types/types';
import { swap_placeholders } from '~/utils/Helpers';

const props = defineProps<{
  currentPage: number,
  data: Pagination,
  historyUrl: string
}>();

const emit = defineEmits<{
  paginate: [page: number]
}>()

const pages = initPages(props.data);

function initPages(data: Pagination): Array<number> {
  const pageCount = Math.ceil(Math.max(data.entriesTotal, data.entriesTo) / 10);

  return Array(pageCount)
    .fill(1, 0, pageCount)
    .map((n, i) => n + i);
}

function hasPrev(page: number): boolean {
  return page > 1;
}

function hasNext(page: number): boolean {
  return pages.length > page;
}


function link(page: number): string {
  return swap_placeholders(props.historyUrl, {
    page: page === 1
      ? ''
      : page
    });
}


</script>