let CONFIG;

const initConfig = () => {
  if (CONFIG) {
    return Promise.resolve(CONFIG);
  }
  return fetch('./config.json')
    .then(r => r.json())
    .then(config => {
      CONFIG = config;
      return CONFIG;
    });
};

const setConfigs = () => {
  initConfig().then(config => {
    const elements = document.querySelectorAll('[config]');
    for (let element of elements) {
      element.innerHTML = config[element.getAttribute('config')];
    }
  });
};

const getConfig = async (keys) => {
  let value = await initConfig();
  keys.split('.').forEach(key => value = value[key]);
  return value;
};