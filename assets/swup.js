import Swup from 'swup';
import ProgressBarPlugin from '@swup/progress-plugin';

const progressBar = new ProgressBarPlugin({
  delay: 0,
  initialValue: 0.05
})

const swupInstance = new Swup({
  containers: ['#swup-container'],
  cache: false,
  linkToSelf: 'navigate',
  plugins: [progressBar]
});
// set to access from JobListing.vue in paginator mode
swupInstance.progressBar = progressBar;
window.swup = swupInstance;