<template>
  <div>
  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="text-center" v-if="fetch_error">
      <h3 class="mt-5">Something is broken</h3>
      <img src="https://cdn-icons-png.flaticon.com/128/8502/8502166.png" class="my-5">
    </div>
    <div v-else>
    <h6 class="border-bottom pb-2 mb-0">Hot Jobs</h6>
    <div class="d-flex text-body-secondary pt-3" v-for="job in listing">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect></svg>
      <p class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <a :href="makeLink(job)">
          <strong class="d-block text-gray-dark">{{ job.title }}</strong>
        </a>
        <div class="d-flex align-items-center gap-1">
          <i class="bi bi-suitcase-lg-fill mt-1"></i> {{ job.employment.name }}
        </div>
      </p>
    </div>
      <button v-if="!paginatorMode && initialized" type="button" class="btn btn-sm w-100 mt-4" :class="{ 'btn-outline-secondary': !isFetching, 'btn-light': isFetching}" @click="fetchNextPage">
        <svg v-if="isFetching" width="32" height="32" >
          <use xlink:href="#loader"></use>
        </svg>
        <span v-else>Načíst další</span>
      </button>
    </div>
  </div>

  <div v-if="paginatorMode">
    <!-- TODO: -->
  </div>
</div>
</template>

<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import { swap_placeholders } from '~/utils/Helpers';
  import type { JobListing, JobListingResponse } from '~/types/types';

  const props = defineProps({
    apiUrl: { type: String, required: true },
    historyUrl: { type: String, required: true },
    detailUrl: { type: String, required: true },
    page: { type: Number, default: 1},
  });

  const paginatorMode = props.page !== 1;

  let currentPage = ref(props.page);
  let listing = ref<Array<JobListing>>([]);
  let initialized = ref(false);
  let isFetching = ref(!false);
  let fetch_error = ref(false);

  function fetchPage(pageToFetch?: number) {
    if (!pageToFetch) {
      pageToFetch = currentPage.value + 1;
    }
    const url = swap_placeholders(props.apiUrl, { page: pageToFetch });

    isFetching.value = true;
    return fetch(url)
      .then(res => res.json())
      .then((json: JobListingResponse) => {
        currentPage.value = pageToFetch;
        if (json.payload === null) {
          listing.value = [];
          return;
        }

        listing.value = paginatorMode
          ? json.payload
          : listing.value.concat(...json.payload)
      })
      .catch(e => {
        fetch_error.value = true;
      })
      .finally(() => {
        isFetching.value = false;
      });
  }


  function makeLink({ jobId, slug }: JobListing) {
    return swap_placeholders(props.detailUrl, {id: jobId, slug});
  }

  function fetchNextPage() {
    fetchPage();
  }

  onMounted(() => {
    fetchPage(props.page)
    .then(() => {
      initialized.value = true;
    });
  });
</script>
