<template>
  <div class="lg:w-1/3 max-h-screen lg:border-l lg:border-grey-100 py-10 md:px-5 lg:ml-10 flex flex-col items-center sticky top-0">
    <div class="flex justify-center items-center text-2xl">
      <box-icon type='logo' name='twitter' size="lg"></box-icon>
      <box-icon type='logo' name='linkedin-square' size="lg"></box-icon>
      <box-icon type='logo' name='paypal' size="lg"></box-icon>
      <box-icon type='logo' name='patreon' size="lg"></box-icon>
    </div>
    <div class="xl:mt-10 mt-5 flex flex-col items-center">
      <h2 class="font-semibold text-center text-2xl">About Finance College</h2>
      <div class="flex flex-wrap xl:justify-center gap-5 text-center">
        <div>Ut non mauris porta, rhoncus velit sed, semper nisi. Nulla facilisi. Nulla ac pharetra massa. Curabitur ornare orci lectus.</div>
        <div>Ut non mauris porta, rhoncus velit sed, semper nisi. Nulla facilisi. Nulla ac pharetra massa. Curabitur ornare orci lectus.</div>
      </div>
    </div>
    <div class="xl:mt-10 mt-5 flex flex-col items-center">
      <h2 class="font-semibold text-center text-2xl">Top Topics to Explore</h2>
      <div class="flex flex-wrap lg:gap-5 gap-3 font-lg">
        <div class="tag">Loans</div>
        <div class="tag">Mortgage</div>
        <div class="tag">Interest</div>
        <div class="tag">401k</div>
        <div class="tag">Investing</div>
      </div>
    </div>
    <footer class="flex flex-wrap justify-center lg:gap-5 gap-3 xl:mt-10 mt-5 text-gray-600">
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
    border-radius: 30px;
    padding: .5rem;
    color:white;
    font-weight: 600;
    background: rgb(4, 120, 87);
    max-width: max-content;
}
.tag:hover {
  background-color: rgb(3, 211, 152);
  color:black;
  font-weight: 600;
}
</style>