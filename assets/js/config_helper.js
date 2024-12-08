let CONFIG;

const initConfig = next => {
  if(CONFIG)
    return next;
  fetch('./config.json')
  .then(r => r.json())
  .then(config => next(config));
}
const setConfigs = () => {
  initConfig(config => {
    const elements = document.querySelectorAll('[config]');
    for(let element of elements)
      element.innerHTML = config[element.getAttribute('config')];
  });
};