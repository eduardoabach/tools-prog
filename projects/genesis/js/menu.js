var menuInteract = [
      [ "Conversar", "abrirConversa();"],
      [ "Comportamento", "abrirComportameto();"],
      [ "Ensinar Palavras", "abrirAprenderPalavra();"],
      [ "Ensinar Frases", "abrirAprenderFrase();"],
      [ "Ensinar Frases", "abrirAprenderFrase();"]
   ];

var camera, scene, renderer;
var controls;

var objetosList = [];
var objetoMenu = { estrutura: []};

function iniciarMenu(){
   initMenu();
   animate();
}

function initMenu() {

   camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 5000 );
   camera.position.z = 1800;
   scene = new THREE.Scene();
   var tipoExibir = 'plano_reto';

   for ( var i = 0; i < menuInteract.length; i ++ ) {
      var item = menuInteract[ i ];

      var element = document.createElement( 'div' );
      element.className = 'element';
      element.style.backgroundColor = 'rgba(127,0,0,' + ( Math.random() * 0.5 + 0.25 ) + ')';

      var symbol = document.createElement( 'div' );
      symbol.className = 'symbol';
      symbol.textContent = item[0];
      symbol.setAttribute("onclick", item[1]);
      element.appendChild( symbol );

      var object = new THREE.CSS3DObject( element );
      object.position.x = Math.random() * 4000 - 2000;
      object.position.y = Math.random() * 4000 - 2000;
      object.position.z = Math.random() * 4000 - 2000;
      scene.add( object );

      objetosList.push( object );
   }

   if(tipoExibir == 'plano_reto'){

      var positAt = 180;
      for ( var i = 0; i < objetosList.length; i ++ ) {
         var object = new THREE.Object3D();
         positAt = positAt*-1;
         object.position.x = ( i * 700 )-1200;
         object.position.y = positAt;
         object.position.z = positAt;
         objetoMenu.estrutura.push( object );
      }

   } else if(tipoExibir == 'circulo'){

      var vector = new THREE.Vector3();
      for ( var i = 0, l = objetosList.length; i < l; i ++ ) {
         var phi = i + Math.PI;
         var object = new THREE.Object3D();

         object.position.x = 650 * Math.sin( phi );
         object.position.y = 0;
         object.position.z = 650 * Math.cos( phi );

         vector.copy( object.position );
         vector.x *= 2;
         vector.z *= 2;

         object.lookAt( vector );
         objetoMenu.estrutura.push( object );
      }

   }

   //

   renderer = new THREE.CSS3DRenderer();
   renderer.setSize( window.innerWidth, window.innerHeight );
   renderer.domElement.style.position = 'absolute';
   document.getElementById( 'menuMovel' ).appendChild( renderer.domElement );

   //

   controls = new THREE.TrackballControls( camera, renderer.domElement );
   controls.rotateSpeed = 0.5;
   controls.addEventListener( 'change', render );

   transformMenu( objetoMenu.estrutura, 2000 );

   //

   window.addEventListener( 'resize', onWindowResize, false );
}

function transformMenu( targets, duration ) {
   TWEEN.removeAll();
   for ( var i = 0; i < objetosList.length; i ++ ) {
      var object = objetosList[ i ];
      var target = targets[ i ];

      new TWEEN.Tween( object.position )
         .to( { x: target.position.x, y: target.position.y, z: target.position.z }, Math.random() * duration + duration )
         .easing( TWEEN.Easing.Exponential.InOut )
         .start();

      new TWEEN.Tween( object.rotation )
         .to( { x: target.rotation.x, y: target.rotation.y, z: target.rotation.z }, Math.random() * duration + duration )
         .easing( TWEEN.Easing.Exponential.InOut )
         .start();
   }

   new TWEEN.Tween( this )
      .to( {}, duration * 2 )
      .onUpdate( render )
      .start();
}

function onWindowResize() {
   camera.aspect = window.innerWidth / window.innerHeight;
   camera.updateProjectionMatrix();
   renderer.setSize( window.innerWidth, window.innerHeight );
}

function animate() {
   requestAnimationFrame( animate );
   TWEEN.update();
   controls.update();
}

function render() {
   renderer.render( scene, camera );
}