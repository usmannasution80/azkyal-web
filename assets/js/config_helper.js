const setConfigs = () => {
  const elements = document.querySelectorAll('[config]');
  for (let element of elements)
    element.innerHTML = CONFIG[element.getAttribute('config')];
};

const getConfig = keys => {
  let value = CONFIG;
  keys.split('.').forEach(key => value = value[key]);
  return value;
};