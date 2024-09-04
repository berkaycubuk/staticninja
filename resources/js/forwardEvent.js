import { createEventDispatcher } from 'svelte';

export function forwardEvent() {
  const dispatch = createEventDispatcher();

  return (event) => {
    event.stopPropagation();
    dispatch(event.type, event.detail);
  };
}
