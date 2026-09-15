<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Inclusion des bibliothèques A-Frame et MindAR -->
    <script src="https://aframe.io/releases/1.5.0/aframe.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mind-ar@1.2.5/dist/mindar-image-aframe.prod.js"></script>
  </head>
  <body>
    <!-- Scène AR -->
    <a-scene mindar-image="imageTargetSrc: ./targets.mind;" color-space="sRGB" renderer="colorManagement: true, physicallyCorrectLights" vr-mode-ui="enabled: false" device-orientation-permission-ui="enabled: false">
      
      <!-- Préchargement des assets (vidéo) -->
      <a-assets>
        <video
          id="arVideo"
          src="./AnimationLogo.mp4"
          preload="auto"
          loop
          muted
          playsinline
          webkit-playsinline
          crossorigin="anonymous"
        ></video>
      </a-assets>

      <a-camera position="0 0 0" look-controls="enabled: false"></a-camera>

      <!-- Lien entre la cible détectée (index 0) et la vidéo -->
      <a-entity mindar-image-target="targetIndex: 0">
        <!-- a-plane affiche la vidéo comme texture sur un plan plat -->
        <!-- Ajustez width/height selon le ratio de votre vidéo (ex: 16:9 → width="1.6" height="0.9") -->
        <a-plane
          src="#arVideo"
          position="0 0 0"
          width="1"
          height="0.55"
          rotation="0 0 0"
          material="src: #arVideo; shader: flat"
        ></a-plane>
      </a-entity>
      
    </a-scene>

    <script>
      // Lance la vidéo dès que la cible AR est détectée
      document.addEventListener("DOMContentLoaded", () => {
        const scene = document.querySelector("a-scene");
        const video = document.querySelector("#arVideo");
        const target = document.querySelector("[mindar-image-target]");

        target.addEventListener("targetFound", () => {
          video.play();
        });

        target.addEventListener("targetLost", () => {
          video.pause();
        });
      });
    </script>
  </body>
</html>