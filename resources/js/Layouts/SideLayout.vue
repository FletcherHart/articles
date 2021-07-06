<template>
  <div class="md:w-1/3 max-h-screen md:border-l md:border-grey-100 py-10 px-5 md:ml-10 sticky top-0 flex flex-col items-center">
    <div class="flex justify-center items-center text-2xl">
      <box-icon type='logo' name='twitter' size="lg"></box-icon>
      <box-icon type='logo' name='linkedin-square' size="lg"></box-icon>
      <box-icon type='logo' name='paypal' size="lg"></box-icon>
      <box-icon type='logo' name='patreon' size="lg"></box-icon>
    </div>
    <div class="m-5 flex flex-col items-center">
      <h2 class="font-semibold text-2xl">About Finance College</h2>
      <div class="flex flex-wrap justify-center gap-5">
        <div>Ut non mauris porta, rhoncus velit sed, semper nisi. Nulla facilisi. Nulla ac pharetra massa. Curabitur ornare orci lectus.</div>
        <div>Ut non mauris porta, rhoncus velit sed, semper nisi. Nulla facilisi. Nulla ac pharetra massa. Curabitur ornare orci lectus.</div>
        <div>Ut non mauris porta, rhoncus velit sed, semper nisi. Nulla facilisi. Nulla ac pharetra massa. Curabitur ornare orci lectus.</div>
      </div>
    </div>
    <div class="m-5 flex flex-col items-center">
      <h2 class="font-semibold text-2xl">Top Topics to Explore</h2>
      <div class="flex flex-wrap justify-center font-lg">
        <div class="tag">Loans</div>
        <div class="tag">Mortgage</div>
        <div class="tag">Interest</div>
        <div class="tag">401k</div>
        <div class="tag">Investing</div>
      </div>
    </div>
    <footer class="flex flex-wrap justify-center gap-5 text-gray-600">
      <inertia-link href="#">Placeholder 1</inertia-link>
      <inertia-link href="#">Placeholder 2</inertia-link>
      <inertia-link href="#">Placeholder 3</inertia-link>
      <inertia-link href="#">Placeholder 4</inertia-link>
      <inertia-link href="#">Placeholder 5</inertia-link>
    </footer>
  </div>
</template>


<style scoped>
box-icon {
  fill: rgb(4, 120, 87);
}
box-icon:hover {
  fill: rgb(3, 211, 152);
}
.tag {
    border-radius: 50px;
    padding: .4rem;
    border: 2px solid rgb(4, 120, 87);
    max-width: max-content;
    margin: 0.5rem;
}
.tag:hover {
  background-color: rgb(4, 120, 87);
  color:white;
  font-weight: 600;
}
</style>