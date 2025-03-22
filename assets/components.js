import { defineCustomElement } from 'vue';

import JobList from './components/JobListing.vue';
import JobAnswerForm from './components/JobAnswerForm.vue';

window.customElements.define('vue-job-list', defineCustomElement(JobList, { shadowRoot: false }));
window.customElements.define('vue-answer-form', defineCustomElement(JobAnswerForm, { shadowRoot: false }));

