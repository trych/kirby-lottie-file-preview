panel.plugin("trych/lottie-file-preview", {
  components: {
    "k-lottie-file-preview": {
      template: `
        <figure class="k-default-file-preview k-lottie-file-preview" :style="cssVars">
          <k-file-preview-frame :style="{ backgroundColor: playerOptions.background }">
      			<script type="module" :src="asset"></script>
            <lottie-player
              :src="url"
              :background="playerOptions.background"
              :speed="playerOptions.speed"
              :loop="playerOptions.loop"
              :autoplay="playerOptions.autoplay"
              :controls="playerOptions.controls"
              :direction="playerOptions.direction"
              :mode="playerOptions.mode"
            >
            </lottie-player>
          </k-file-preview-frame>

          <k-file-preview-details :details="details" />
        </figure>
      `,
      computed: {
        cssVars() {
          return {
            '--lottie-bg': this.playerOptions.background
          };
        }
      },
      props: {
      	asset: String,
        details: Array,
        url: String,
        playerOptions: Object
      }
    },
  }
});
