<template>
  <div class="answer-container bg-body" :class="{ 'collapsed': !initialized }">
    <div class="inner-content" id="answer-form">
      <button v-if="!initialized" @click="showForm" class="btn btn-primary w-100">Mám zájem o tuto pozici</button>
      <form v-else-if="!isDone" method="post" :action="apiUrl" @submit.prevent="ajaxSubmit" autocomplete="off">
        <div class="row mb-3" v-for="field in formFields">
          <div class="col">
            <label :for="`${field.name}-${field.type}`">{{  field.label }} <span class="text-danger" v-if="field.required">*</span></label>
            <textarea v-if="field.type === 'textarea'"
              :id="`${field.name}-${field.type}`"
              :name="field.name"
              :type="field.type"
              :required="field.required"
              :value="field.value"
              class="form-control"
            ></textarea>
            <select v-else-if="field.type.includes('select')"
              :multiple="field.type === 'select:m'"
              :id="`${field.name}-${field.type}`"
              :name="field.name"
              :required="field.required"
              :value="field.value"
              class="form-control"
            >
              <option v-for="[val, k] in Object.entries(field.options)" :value="k">{{ val }}</option>
            </select>
            <input v-else
              :id="`${field.name}-${field.type}`"
              :name="field.name"
              :type="field.type"
              :required="field.required"
              :value="field.value"
              class="form-control"
            >
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <input v-for="hidden in hiddenFields" type="hidden" :name="hidden.name" :value="hidden.value">
            <button type="submit" class="btn btn-primary w-100 submit-btn">
              <svg width="20" height="20" style="--loader: #fff">
                <use xlink:href="#loader"></use>
              </svg>
              <span>Odeslat formulář</span>
            </button>
          </div>
        </div>
      </form>
      <div v-else class="p-5 text-center bg-success text-white">
        Hotovo! 
      </div>
    </div>
  
  </div>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted, nextTick, computed } from 'vue';
  import type { AnswerResponse, FormDefinitionResponse, FormField } from '~/types/types';
  
  const props = defineProps({
    apiUrl: { type: String, required: true }
  });
  
  let formFields = ref<FormField[]>([]);
  let hiddenFields = ref<FormField[]>([]);
  
  let initialized = ref(false);
  let isSubmitting = ref(false);
  let isDone = ref(false);
  
  function fetchFormDefinition() {
    fetch(props.apiUrl, { method: 'get' })
      .then(res => res.json())
      .then((json: FormDefinitionResponse) => {
        if (json.fields) {
          formFields.value = json.fields
            .filter(f => f.hidden === false)
            .sort((a, b) => a.order <= b.order ? -1 : 1);
          hiddenFields.value = json.fields.filter(f => f.hidden === true);

          return;
        }

        formFields.value = [];
      });
  }
  
  function showForm() {
    initialized.value = true;
    nextTick().then(() => {
      document.getElementById('answer-form')?.scrollIntoView();
    });
  }
  
  function ajaxSubmit(e: { target: HTMLFormElement }) {
    if (isSubmitting.value) return;
  
    isSubmitting.value = true;
    const form = e.target;
    const submitBtn = form.querySelector('.submit-btn');
    submitBtn?.classList.add('submitting');

    fetch(props.apiUrl, {
      method: 'post',
      body: new FormData(form)
    }).then(res => res.json())
      .then((json: AnswerResponse) => {
        if (json.meta.code.includes('api.error')) {
          alert(json.meta.message);
        } else {
          isDone.value = true;
        }
      })
      .finally(() => {
        isSubmitting.value = false;
        submitBtn?.classList.remove('submitting');
      });
  }
  
  onMounted(fetchFormDefinition);
  </script>
  
  <style>
  .answer-container {
    /* margin: 28px -40px 80px; */
    bottom: 0;
    box-shadow: 0 -1.5rem 1rem #fffc;
    padding-bottom: 0.5rem;
  }
  .collapsed {
    position: sticky;
  }
  .inner-content {
    margin: 0.5rem 0;
  }
  .submit-btn svg {
    display: none;
  }
  .submit-btn.submitting span {
    display: none;
  }
  .submit-btn.submitting svg {
    display: inline;
  }
  </style>
  
  