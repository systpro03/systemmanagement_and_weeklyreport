<!doctype html>
<html lang="en" data-preloader="enable">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta charset="utf-8" />
        <title>Corporate IT Sysdev</title>
        <link rel="shortcut icon" href="assets/images/it.jpg" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.css">
        <!-- Toastr JS -->
        <style>
            canvas#ghost {
                position: fixed;
                top: 0;
                left: 0;
                display: block;
                width: 100%;
                z-index: 10000;
                pointer-events: none;
            }

            .page {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                text-align: center;
                font-size: 4vw;
                text-shadow: 0 0 5px #000000;
            }

            .lil-gui {
                --width: 250px;
                max-width: 90%;
                --widget-height: 20px;
                font-size: 15px;
                --input-font-size: 15px;
                --padding: 10px;
                --spacing: 10px;
                --slider-knob-width: 5px;
                --background-color: rgba(5, 0, 15, .8);
                --widget-color: rgba(255, 255, 255, .3);
                --focus-color: rgba(255, 255, 255, .4);
                --hover-color: rgba(255, 255, 255, .5);
                --font-family: monospace;
                z-index: 1;
            }
        </style>
    </head>

    <body>
        <script type="x-shader/x-fragment" id="vertShader">
            precision mediump float;
            varying vec2 vUv;
            attribute vec2 a_position;

            void main() {
            vUv = .5 * (a_position + 1.);
            gl_Position = vec4(a_position, 0.0, 1.0);
            }
        </script>
        <!-- Fragment Shader -->
        <script type="x-shader/x-fragment" id="fragShader">
            precision mediump float;

            varying vec2 vUv;
            uniform float u_time;
            uniform float u_ratio;
            uniform float u_size;
            uniform vec2 u_pointer;
            uniform float u_smile;
            uniform vec2 u_target_pointer;
            uniform vec3 u_main_color;
            uniform vec3 u_border_color;
            uniform float u_flat_color;
            uniform sampler2D u_texture;

            #define TWO_PI 6.28318530718
            #define PI 3.14159265358979323846

            vec3 mod289(vec3 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
            vec2 mod289(vec2 x) { return x - floor(x * (1.0 / 289.0)) * 289.0; }
            vec3 permute(vec3 x) { return mod289(((x*34.0)+1.0)*x); }
            float snoise(vec2 v) {
            const vec4 C = vec4(0.211324865405187, 0.366025403784439,
                                -0.577350269189626, 0.024390243902439);
            vec2 i = floor(v + dot(v, C.yy));
            vec2 x0 = v - i + dot(i, C.xx);
            vec2 i1;
            i1 = (x0.x > x0.y) ? vec2(1.0, 0.0) : vec2(0.0, 1.0);
            vec4 x12 = x0.xyxy + C.xxzz;
            x12.xy -= i1;
            i = mod289(i);
            vec3 p = permute(permute(i.y + vec3(0.0, i1.y, 1.0))
                            + i.x + vec3(0.0, i1.x, 1.0));
            vec3 m = max(0.5 - vec3(dot(x0, x0),
                                    dot(x12.xy, x12.xy),
                                    dot(x12.zw, x12.zw)), 0.0);
            m = m*m;
            m = m*m;
            vec3 x = 2.0 * fract(p * C.www) - 1.0;
            vec3 h = abs(x) - 0.5;
            vec3 ox = floor(x + 0.5);
            vec3 a0 = x - ox;
            m *= 1.79284291400159 - 0.85373472095314 *
                (a0*a0 + h*h);
            vec3 g;
            g.x = a0.x * x0.x + h.x * x0.y;
            g.yz = a0.yz * x12.xz + h.yz * x12.yw;
            return 130.0 * dot(m, g);
            }

            vec2 rotate(vec2 v, float angle) {
            float r_sin = sin(angle);
            float r_cos = cos(angle);
            return vec2(v.x * r_cos - v.y * r_sin,
                        v.x * r_sin + v.y * r_cos);
            }

            float eyes(vec2 uv) {
            uv.y -= .5;
            uv.y *= .8;
            uv.x = abs(uv.x);
            uv.y += u_smile * .3 * pow(uv.x, 1.3);
            uv.x -= (.6 + .2 * u_smile);
            float d = clamp(length(uv), 0., 1.);
            return 1. - pow(d, .08);
            }

            float mouth(vec2 uv) {
            uv.y += 1.5;
            uv.x *= (.5 + .5 * abs(1. - u_smile));
            uv.y *= (3. - 2. * abs(1. - u_smile));
            uv.y -= u_smile * 4. * pow(uv.x, 2.);
            float d = clamp(length(uv), 0., 1.);
            return 1. - pow(d, .07);
            }

            float face(vec2 uv, float rotation) {
            uv = rotate(uv, rotation);
            uv /= (.27 * u_size);
            float eyes_shape = 10. * eyes(uv);
            float mouth_shape = 20. * mouth(uv);
            float col = 0.;
            col = mix(col, 1., eyes_shape);
            col = mix(col, 1., mouth_shape);
            return col;
            }

            void main() {
            vec2 point = u_pointer;
            point.x *= u_ratio;
            vec2 uv = vUv;
            uv.x *= u_ratio;
            uv -= point;
            float texture = texture2D(u_texture,
                                        vec2(vUv.x, 1. - vUv.y)).r;
            float shape = texture;
            float noise = snoise(uv * vec2(.7 / u_size, .6 / u_size) +
                                vec2(0., .0015 * u_time));
            noise += 1.2;
            noise *= 2.1;
            noise += smoothstep(-.8, -.2, (uv.y) / u_size);
            float face = face(uv, 5. * (u_target_pointer.x - u_pointer.x));
            shape -= face;
            shape *= noise;
            vec3 border = (1. - u_border_color);
            border.g += .2 * sin(.005 * u_time);
            border *= .5;
            vec3 color = u_main_color;
            color -= (1. - u_flat_color) * border *
                    smoothstep(.0, .01, shape);
            shape = u_flat_color * smoothstep(.8, 1., shape)
                    + (1. - u_flat_color) * shape;
            color *= shape;
            gl_FragColor = vec4(color, shape);
            }
        </script>
        <!-- Main Script -->
        <script type="module">
            import GUI from "<?php echo base_url(); ?>assets/js/gui.js";

            const canvasEl = document.querySelector("#ghost");

            const mouseThreshold = .1;
            const devicePixelRatio = Math.min(window.devicePixelRatio, 2);

            const mouse = {
                x: .25 * window.innerWidth,
                y: .8 * window.innerHeight,
                tX: .25 * window.innerWidth,
                tY: .8 * window.innerHeight,
                moving: false,
                controlsPadding: 0
            };

            const params = {
                size: .055,
                tail: { dotsNumber: 35, spring: 1.4, friction: .3, gravity: 0 },
                smile: 1,
                mainColor: [.98, .96, .96],
                borderColor: [.2, .5, .7],
                isFlatColor: false,
            };

            const textureEl = document.createElement("canvas");
            const textureCtx = textureEl.getContext("2d");
            const pointerTrail = new Array(params.tail.dotsNumber);
            let dotSize = (i) => params.size * window.innerHeight *
                (1. - .2 * Math.pow(3. * i / params.tail.dotsNumber - 1., 2.));

            for (let i = 0; i < params.tail.dotsNumber; i++) {
                pointerTrail[i] = {
                    x: mouse.x, y: mouse.y,
                    vx: 0, vy: 0,
                    opacity: .04 + .3 * Math.pow(1 - i / params.tail.dotsNumber, 4),
                    bordered: .6 * Math.pow(1 - i / pointerTrail.length, 1),
                    r: dotSize(i)
                };
            }

            let uniforms;
            const gl = initShader();
            // createControls();

            window.addEventListener("resize", resizeCanvas);
            resizeCanvas();
            render();

            window.addEventListener("mousemove", e => updateMousePosition(e.clientX, e.clientY));
            window.addEventListener("touchmove", e => updateMousePosition(e.targetTouches[0].clientX, e.targetTouches[0].clientY));
            window.addEventListener("click", e => updateMousePosition(e.clientX, e.clientY));

            let movingTimer = setTimeout(() => mouse.moving = false, 300);

            function updateMousePosition(eX, eY) {
                mouse.moving = true;
                if (mouse.controlsPadding < 0) mouse.moving = false;
                clearTimeout(movingTimer);
                movingTimer = setTimeout(() => { mouse.moving = false; }, 300);
                mouse.tX = eX;
                const size = params.size * window.innerHeight;
                eY -= .6 * size;
                mouse.tY = eY > size ? eY : size;
                mouse.tY -= mouse.controlsPadding;
            }

            function initShader() {
                const vsSource = document.getElementById("vertShader").innerHTML;
                const fsSource = document.getElementById("fragShader").innerHTML;
                const gl = canvasEl.getContext("webgl") || canvasEl.getContext("experimental-webgl");
                if (!gl) alert("WebGL is not supported by your browser.");

                function createShader(gl, sourceCode, type) {
                    const shader = gl.createShader(type);
                    gl.shaderSource(shader, sourceCode);
                    gl.compileShader(shader);
                    if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                        console.error("Shader error: " + gl.getShaderInfoLog(shader));
                        gl.deleteShader(shader);
                        return null;
                    }
                    return shader;
                }

                const vertexShader = createShader(gl, vsSource, gl.VERTEX_SHADER);
                const fragmentShader = createShader(gl, fsSource, gl.FRAGMENT_SHADER);

                function createShaderProgram(gl, vertexShader, fragmentShader) {
                    const program = gl.createProgram();
                    gl.attachShader(program, vertexShader);
                    gl.attachShader(program, fragmentShader);
                    gl.linkProgram(program);
                    if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
                        console.error("Program error: " + gl.getProgramInfoLog(program));
                        return null;
                    }
                    return program;
                }

                const shaderProgram = createShaderProgram(gl, vertexShader, fragmentShader);
                uniforms = getUniforms(shaderProgram);

                function getUniforms(program) {
                    let uniforms = [];
                    let uniformCount = gl.getProgramParameter(program, gl.ACTIVE_UNIFORMS);
                    for (let i = 0; i < uniformCount; i++) {
                        let uniformName = gl.getActiveUniform(program, i).name;
                        uniforms[uniformName] = gl.getUniformLocation(program, uniformName);
                    }
                    return uniforms;
                }

                const vertices = new Float32Array([-1., -1., 1., -1., -1., 1., 1., 1.]);
                const vertexBuffer = gl.createBuffer();
                gl.bindBuffer(gl.ARRAY_BUFFER, vertexBuffer);
                gl.bufferData(gl.ARRAY_BUFFER, vertices, gl.STATIC_DRAW);
                gl.useProgram(shaderProgram);

                const positionLocation = gl.getAttribLocation(shaderProgram, "a_position");
                gl.enableVertexAttribArray(positionLocation);
                gl.bindBuffer(gl.ARRAY_BUFFER, vertexBuffer);
                gl.vertexAttribPointer(positionLocation, 2, gl.FLOAT, false, 0, 0);

                const canvasTexture = gl.createTexture();
                gl.bindTexture(gl.TEXTURE_2D, canvasTexture);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
                gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, textureEl);
                gl.uniform1i(uniforms.u_texture, 0);

                gl.uniform1f(uniforms.u_size, params.size);
                gl.uniform3f(uniforms.u_main_color, params.mainColor[0], params.mainColor[1], params.mainColor[2]);
                gl.uniform3f(uniforms.u_border_color, params.borderColor[0], params.borderColor[1], params.borderColor[2]);

                return gl;
            }

            function updateTexture() {
                textureCtx.fillStyle = 'black';
                textureCtx.fillRect(0, 0, textureEl.width, textureEl.height);
                pointerTrail.forEach((p, pIdx) => {
                    if (pIdx === 0) { p.x = mouse.x; p.y = mouse.y; }
                    else {
                        p.vx += (pointerTrail[pIdx - 1].x - p.x) * params.tail.spring;
                        p.vx *= params.tail.friction;
                        p.vy += (pointerTrail[pIdx - 1].y - p.y) * params.tail.spring;
                        p.vy *= params.tail.friction;
                        p.vy += params.tail.gravity;
                        p.x += p.vx; p.y += p.vy;
                    }
                    const grd = textureCtx.createRadialGradient(p.x, p.y, p.r * p.bordered, p.x, p.y, p.r);
                    grd.addColorStop(0, 'rgba(255,255,255,' + p.opacity + ')');
                    grd.addColorStop(1, 'rgba(255,255,255,0)');
                    textureCtx.beginPath();
                    textureCtx.fillStyle = grd;
                    textureCtx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                    textureCtx.fill();
                });
            }

            function render() {
                const currentTime = performance.now();
                gl.uniform1f(uniforms.u_time, currentTime);
                gl.clearColor(0.0, 0.0, 0.0, 1.0);
                gl.clear(gl.COLOR_BUFFER_BIT);
                gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);

                if (mouse.moving) {
                    params.smile -= .05;
                    params.smile = Math.max(params.smile, -.1);
                    params.tail.gravity -= 10 * params.size;
                    params.tail.gravity = Math.max(params.tail.gravity, 0);
                } else {
                    params.smile += .01;
                    params.smile = Math.min(params.smile, 1);
                    if (params.tail.gravity > 25 * params.size) {
                        params.tail.gravity = (25 + 5 * (1 + Math.sin(.002 * currentTime))) * params.size;
                    } else {
                        params.tail.gravity += params.size;
                    }
                }

                mouse.x += (mouse.tX - mouse.x) * mouseThreshold;
                mouse.y += (mouse.tY - mouse.y) * mouseThreshold;

                gl.uniform1f(uniforms.u_smile, params.smile);
                gl.uniform2f(uniforms.u_pointer, mouse.x / window.innerWidth, 1. - mouse.y / window.innerHeight);
                gl.uniform2f(uniforms.u_target_pointer, mouse.tX / window.innerWidth, 1. - mouse.tY / window.innerHeight);

                updateTexture();
                gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, textureEl);
                requestAnimationFrame(render);
            }

            function resizeCanvas() {
                canvasEl.width = window.innerWidth * devicePixelRatio;
                canvasEl.height = window.innerHeight * devicePixelRatio;
                textureEl.width = window.innerWidth;
                textureEl.height = window.innerHeight;
                gl.viewport(0, 0, canvasEl.width, canvasEl.height);
                gl.uniform1f(uniforms.u_ratio, canvasEl.width / canvasEl.height);
                for (let i = 0; i < params.tail.dotsNumber; i++) pointerTrail[i].r = dotSize(i);
            }

            function createControls() {
                const gui = new GUI(); gui.close();
                gui.add(params, "size", .02, .3, .01).onChange(() => {
                    for (let i = 0; i < params.tail.dotsNumber; i++) pointerTrail[i].r = dotSize(i);
                    gl.uniform1f(uniforms.u_size, params.size);
                });
                gui.addColor(params, "mainColor").onChange(v => gl.uniform3f(uniforms.u_main_color, v[0], v[1], v[2]));
                const borderColorControl = gui.addColor(params, "borderColor").onChange(v => gl.uniform3f(uniforms.u_border_color, v[0], v[1], v[2]));
                gui.add(params, "isFlatColor").onFinishChange(v => {
                    borderColorControl.disable(v);
                    gl.uniform1f(uniforms.u_flat_color, v ? 1 : 0);
                });

                const controlsEl = document.querySelector(".lil-gui");
                controlsEl.addEventListener("mouseenter", () => { mouse.controlsPadding = -controlsEl.getBoundingClientRect().height; });
                controlsEl.addEventListener("mouseleave", () => { mouse.controlsPadding = 0; });
            }
        </script>
        <canvas id="ghost"></canvas> 
        <div class="auth-page-wrapper pt-5">
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>
                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                        viewbox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="auth-page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center mt-3 mb-3">
                                <div style="margin-right: 1%;">
                                    <a href="#" class="d-inline-block auth-logo">
                                        <img src="<?php echo base_url(); ?>assets/images/auth.png" alt="" height="70"
                                            width="250" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='box'>
                        <div class='box-form' style="margin-top: 5%;">
                            <div class='box-login-tab'></div>
                            <div class='box-login'>
                                <div class='fieldset-body' id='login_form'>
                                    <form action="<?php echo base_url('login_data') ?>" method="post"
                                        autocomplete="off">
                                        <div class='line-wh'></div>
                                        <p class='field mt-3'>
                                            <label for='user' class="fs-10">Username</label>
                                            <input type='text' class="form-control pe-5 rounded-pill" id='username' style="width: 92%;margin-left: 4.5%;"
                                                name="username" title='Username' autocomplete="off" />
                                        </p>
                                        <p class='field'>
                                            <label for="password-input" class="fs-10">Password </label>
                                        <div class="position-relative auth-pass-inputgroup mb-3"
                                            style="width: 80%;margin-left: 10%;">
                                            <input type="password" class="form-control pe-5 password-input rounded-pill"
                                                name="password" id="password" autocomplete="off" />
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        </p>
                                        <button class="button">
                                            <span class="button_lg">
                                                <span class="button_sl"></span>
                                                <span class="button_text">LOGIN</span>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- <img src="<?php echo base_url(); ?>assets/images/jose.png" alt="" class="img-fluid jose-img" id="jose-img"/> -->
                        </div>
                        <span class="text-muted d-flex justify-content-center mt-3 mb-5"
                            style="margin-right: 10%;"><small>IT SYSTEM VERSION V1.2.0 © 2025</small></span>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="d-flex justify-content-center flex-wrap gap-4 col-md-12" style="margin-top: 21%;">
                    <?php for ($i = 1; $i <= 9; $i++): ?>
                        <div class="d-flex justify-content-center">
                            <img src="<?php echo base_url("assets/images/teamicon/{$i}.png"); ?>"
                                class="img-fluid rounded-circle clickable-img"
                                style="width: 80px; height: 80px; cursor: pointer;" data-bs-toggle="modal"
                                data-bs-target="#imageModal" />
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div id="birthday-marquee" class="header-marquee mt-3"></div>
            <!-- Modal -->
            <div class="modal fade zoomIn" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <img src="" class="img-fluid rounded rounded-circle material-shadow" id="modalImage"
                                alt="Preview">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer text-muted">
            <div class="container-fluid">
                <div class="row">
                <div class="col-sm-6">
                    <span id="year"></span> © System Management v1.2.0
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                    Design by Corporate IT - Sysdev
                    <!-- Game Button -->
                    <!-- <button class="btn btn-sm btn-outline-primary ms-2" data-bs-toggle="modal" data-bs-target="#gameModal">
                        🎮 Play
                    </button> -->
                    </div>
                </div>
                </div>
            </div>
            </footer>
            <!-- Modal -->
            <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="gameModalLabel">Mini Games</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Select a game to play:</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3 mb-3">
                            <button class="btn btn-warning" onclick="loadGame('sudoku')">🔢 Sudoku</button>
                            <button class="btn btn-danger" onclick="loadGame('tetris')">🧱 Tetris</button>
                            <button class="btn btn-success" onclick="loadGame('snake')">🐍 Snake</button>
                            <button class="btn btn-primary" onclick="loadGame('pacman')">👻 Pac-Man</button>
                            <button class="btn btn-info" onclick="loadGame('flappy')">🐦 Flappy Bird</button>
                        </div>

                        <!-- Game Container -->
                        <div id="gameContainer" style="min-height:600px; border:1px solid #ddd; border-radius:10px; padding:10px;">
                        <p class="text-muted">No game loaded yet. Pick one above!</p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <script>
            function loadGame(game) {
            const container = document.getElementById('gameContainer');
            container.innerHTML = ""; // reset

            if (game === 'sudoku') {
                container.innerHTML = `<iframe src="https://sudoku.com/" width="100%" height="700" frameborder="0"></iframe>`;
            } else if (game === 'tetris') {
                container.innerHTML = `<iframe src="https://tetris.com/play-tetris" width="100%" height="700" frameborder="0"></iframe>`;
            } else if (game === 'snake') {
                container.innerHTML = `<iframe src="https://www.snakegame.net/" width="100%" height="700" frameborder="0"></iframe>`;
            } else if (game === 'pacman') {
                container.innerHTML = `<iframe src="https://pacman.live/" width="100%" height="700" frameborder="0"></iframe>`;
            } else if (game === 'flappy') {
                container.innerHTML = `<iframe src="https://flappybird.io/" width="100%" height="700" frameborder="0"></iframe>`;
            } else {
                container.innerHTML = `<p class="text-muted">Game not available.</p>`;
            }
            }

            document.getElementById('year').textContent = new Date().getFullYear();
            </script>


            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const modalImage = document.getElementById("modalImage");

                    document.querySelectorAll(".clickable-img").forEach(img => {
                        img.addEventListener("click", function () {
                            modalImage.src = this.src;
                        });
                    });
                });
            </script>

            <script src="<?php echo base_url(); ?>assets/js/jquery3.6.0.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/feather-icons/feather.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/password-addon.init.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/toastr.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/particles.js/particles.js"></script>
            <script src="<?php echo base_url(); ?>assets/libs/particles.js/particles.app.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/iconify.js"></script>
            <script type="text/javascript">
                <?php if ($this->session->flashdata('message')): ?>
                    $(document).ready(function () {
                        var message = "<?php echo $this->session->flashdata('message'); ?>";
                        var messageType = "<?php echo $this->session->flashdata('message_type'); ?>";
                        toastr.options = {
                            progressBar: true,
                            positionClass: "toast-top-left",
                            timeOut: 3000,
                            extendedTimeOut: 2000,
                            preventDuplicates: true,
                        };
                        if (messageType === "success") {
                            toastr.success(message);
                        } else if (messageType === "error") {
                            toastr.error(message);
                        } else if (messageType === "warning") {
                            toastr.warning(message);
                        } else if (messageType === "info") {
                            toastr.info(message);
                        }
                    });

                <?php endif; ?>
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.querySelector('form');
                    const username = document.getElementById('username');
                    const password = document.getElementById('password');

                    form.addEventListener('submit', function (e) {
                        let usernameEmpty = username.value.trim() === '';
                        let passwordEmpty = password.value.trim() === '';

                        username.classList.remove('is-invalid');
                        password.classList.remove('is-invalid');

                        if (usernameEmpty && passwordEmpty) {
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 1000,
                            };
                            toastr.error('Please input your username and password.');
                            username.classList.add('is-invalid');
                            password.classList.add('is-invalid');
                            e.preventDefault();
                            return;
                        }

                        if (usernameEmpty) {
                            username.classList.add('is-invalid');
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 1000,
                            };
                            toastr.error('Please enter your username.');
                            e.preventDefault();
                            return;
                        }

                        if (passwordEmpty) {
                            password.classList.add('is-invalid');
                            toastr.options = {
                                progressBar: true,
                                positionClass: "toast-top-left",
                                timeOut: 3000,
                                extendedTimeOut: 1000,
                            };
                            toastr.error('Please enter your password.');
                            e.preventDefault();
                            return;
                        }
                    });

                });
            </script>
            <script>
                $(document).ready(function () {

                    function updateMarquee(todayBirthdays) {
                        const marqueeContainer = $('#birthday-marquee');

                        if (todayBirthdays.length > 0) {
                            const marqueeContent = `
                        <iconify-icon icon="noto:confetti-ball"></iconify-icon> 
                        Happy birthday to ${todayBirthdays.join(', ')} 
                        <iconify-icon icon="emojione-v1:birthday-cake"></iconify-icon>
                    `;

                            marqueeContainer.html(`
                        <marquee scrollamount="15">
                            ${marqueeContent}
                        </marquee>
                    `);
                        }
                    }

                    function fetchAndUpdateMarquee() {
                        $.ajax({
                            url: "<?php echo base_url('Auth/Login_ctrl/get_birthdays'); ?>",
                            type: "GET",
                            data: {
                                month: new Date().getMonth() + 1,
                                year: new Date().getFullYear(),
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.status === 'success' && response.data.length > 0) {
                                    const today = new Date();
                                    const todayBirthdays = response.data
                                        .filter(birthday => {
                                            const birthDate = new Date(birthday.birthdate);
                                            return (
                                                birthDate.getDate() === today.getDate() &&
                                                birthDate.getMonth() === today.getMonth()
                                            );
                                        })
                                        .map(person => {
                                            const fullName = `${capitalizeName(person.firstname)} ${capitalizeName(person.lastname)} ${person.suffix}`.trim();
                                            return fullName;
                                        });

                                    updateMarquee(todayBirthdays);
                                }
                            },
                        });
                    }

                    function capitalizeName(name) {
                        return name.split(' ').map(word => {
                            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                        }).join(' ');
                    }

                    fetchAndUpdateMarquee();

                });
            </script>
            <!-- <script>
            $(document).ready(function() {
                $(".button").hover(
                    function() {
                        $("#jose-img").css({opacity: 1, visibility: "visible"});
                    },
                    function() {
                        $("#jose-img").css({opacity: 0, visibility: "hidden"});
                    }
                );
            });

        </script> -->
    </body>

</html>
<style>
    h2,
    h3 {
        font-size: 16px;
        letter-spacing: -1px;
        line-height: 20px;
    }

    h2 {
        color: #747474;
        text-align: center;
    }

    h3 {
        color: #032942;
        text-align: right;
    }

    /*--------------------
Icons
---------------------*/
    .i {
        width: 20px;
        height: 20px;
    }

    .box {
        width: 330px;
        position: absolute;
        top: 180%;
        left: 50.9%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .box-form {
        width: 320px;
        position: relative;
        z-index: 1;
    }

    .box-login-tab {
        margin-top: 25px;
        width: 60%;
        height: 45px;
        background: #fdfdfd;
        position: relative;
        float: left;
        z-index: 1;

        -webkit-border-radius: 6px 6px 0 0;
        -moz-border-radius: 6px 6px 0 0;
        border-radius: 6px 6px 0 0;

        -webkit-transform: perspective(5px) rotateX(0.93deg) translateZ(-1px);
        transform: perspective(5px) rotateX(0.93deg) translateZ(-1px);
        -webkit-transform-origin: 0 0;
        transform-origin: 0 0;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;

        -webkit-box-shadow: 15px -15px 30px rgba(0, 0, 0, 0.32);
        -moz-box-shadow: 15px -15px 30px rgba(0, 0, 0, 0.32);
        box-shadow: 15px -15px 30px rgba(0, 0, 0, 0.32);
    }

    .box-login-title {
        width: 53%;
        height: 50px;
        position: absolute;
        float: left;
        z-index: 2;
    }

    .box-login {
        position: relative;
        top: -3px;
        width: 300px;
        background: #fdfdfd;
        text-align: center;
        overflow: hidden;
        z-index: 2;
        border-top-right-radius: 6px;
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
        box-shadow: 5px 20px 25px rgba(0, 0, 0, 0.32);
    }

    .box-info {
        width: 260px;
        top: 60px;
        position: absolute;
        right: -5px;
        padding: 15px 15px 15px 30px;
        background-color: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.2);
        z-index: 0;
        border-radius: 6px;
        box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.32);
    }

    .line-wh {
        width: 100%;
        height: 1px;
        top: 0px;
        margin: 12px auto;
        position: relative;
    }


    a {
        text-decoration: none;
    }

    button:focus {
        outline: 0;
    }

    .fieldset-body {
        display: table;
    }

    .fieldset-body p {
        width: 100%;
        display: inline-table;
        padding: 5px 20px;
        margin-bottom: 2px;
    }

    label {
        float: left;
        width: 100%;
        top: 0px;
        color: #032942;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        line-height: 1.5;
    }

    label.checkbox {
        float: left;
        padding: 5px 20px;
        line-height: 1.7;
    }

    input[type=text],
    input[type=password] {
        width: 100%;
        height: 40px;
        padding: 0px 10px;
        background-color: rgba(0, 0, 0, 0.03);
        border: none;
        display: inline;
        color: #303030;
        font-size: 12px;
        font-weight: 400;
        float: left;
        border-radius: 10px;
        -webkit-box-shadow: inset 1px 1px 0px rgba(0, 0, 0, 0.05), 1px 1px 0px rgba(255, 255, 255, 1);
        -moz-box-shadow: inset 1px 1px 0px rgba(0, 0, 0, 0.05), 1px 1px 0px rgba(255, 255, 255, 1);
        box-shadow: inset 1px 1px 0px rgba(0, 0, 0, 0.05), 1px 1px 0px rgba(255, 255, 255, 1);
    }

    input[type=text]:focus,
    input[type=password]:focus {
        background-color: #f8f8c6;
        outline: none;
    }

    input[type=submit] {
        width: 100%;
        height: 48px;
        margin-top: 24px;
        padding: 0px 20px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: #fff;
        line-height: 40px;
        text-align: center;
        background-color: rgb(14, 51, 233);
        border: 1px rgb(14, 51, 233) solid;
        opacity: 1;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: rgb(14, 51, 233);
        border: 1px rgb(14, 51, 233) solid;
    }

    input[type=submit]:focus {
        outline: none;
    }

    p.field span.i {
        width: 24px;
        height: 24px;
        float: right;
        position: relative;
        margin-top: -26px;
        right: 2px;
        z-index: 2;
        display: none;
    }

    .swal2-container {
        z-index: 999999999 !important;
        /* Adjust this value as needed */
    }

    /* From Uiverse.io by Praashoo7 */
    .cardm {
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 46.64%;
        left: 50%;
    }

    .card {
        position: absolute;
        width: 250px;
        height: 130px;
        border-radius: 25px;
        background: whitesmoke;
        color: black;
        z-index: 2;
        transition: .4s ease-in-out;
    }

    .weather {
        position: relative;
        margin: 1em;
    }

    .main {
        font-size: 2em;
        position: relative;
        top: -3em;
        left: 4.3em;
    }

    .mainsub {
        position: relative;
        top: -10.2em;
        left: 14em;
        font-size: 0.6em;
    }

    .card2 {
        position: absolute;
        display: flex;
        flex-direction: row;
        width: 240px;
        height: 130px;
        border-radius: 35px;
        background: white;
        z-index: -1;
        transition: .4s ease-in-out;
    }

    .card:hover {
        background-color: #FFE87C;
        cursor: pointer;
    }

    .card:hover+.card2 {
        height: 300px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }

    .card:hover+.card2 .lower {
        top: 20.2em;
    }

    .upper {
        display: flex;
        flex-direction: row;
        position: relative;
        color: black;
        left: 1.8em;
        top: 0.5em;
        gap: 4em;
    }

    .humiditytext {
        position: relative;
        left: 3.6em;
        top: 2.7em;
        font-size: 0.6em;
    }

    .airtext {
        position: relative;
        left: 3.8em;
        top: 2.7em;
        font-size: 0.6em;
    }

    .lower {
        display: flex;
        flex-direction: row;
        position: absolute;
        text-align: center;
        color: black;
        left: 3em;
        top: 1em;
        margin-top: 0.7em;
        font-size: 0.7em;
        transition: .4s ease-in-out;
    }

    .aqi {
        margin-right: 3.25em;
    }

    .realfeel {
        margin-right: 1.8em;
    }

    .card3 {
        position: absolute;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 240px;
        height: 30px;
        top: 4.7em;
        left: -2.4em;
        font-size: 1.24em;
        border-bottom-left-radius: 35px;
        border-bottom-right-radius: 35px;
        background: limegreen;
        transition: .4s ease-in-out;
    }

    .header-marquee {
        /* background-color: #f7f7f7; */
        /* color: #333 !important; */
        color: black !important;
        /* font-weight: bold; */
        /* color: black; */
        /* width: 800px; */



    }

    marquee {
        display: block;
        font-size: 30px;
        font-family: 'BirthdayFont', the-richland;

    }

    @font-face {
        font-family: 'BirthdayFont';
        src: url('<?php echo base_url("assets/fonts/chicken.otf"); ?>') format('opentype');
        font-weight: normal;
        font-style: normal;
    }

    /* From Uiverse.io by mrhyddenn */
    .button {
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        border: none;
        background: none;
        color: #0f1923;
        cursor: pointer;
        position: relative;
        padding: 8px;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 14px;
        transition: all .15s ease;
        width: 230px;
    }

    .button::before,
    .button::after {
        content: '';
        display: block;
        position: absolute;
        right: 0;
        left: 0;
        height: calc(50% - 5px);
        border: 1px solid #7D8082;
        transition: all .15s ease;
    }

    .button::before {
        top: 0;
        border-bottom-width: 0;
    }

    .button::after {
        bottom: 0;
        border-top-width: 0;
    }

    .button:active,
    .button:focus {
        outline: none;
    }

    .button:active::before,
    .button:active::after {
        right: 3px;
        left: 3px;
    }

    .button:active::before {
        top: 3px;
    }

    .button:active::after {
        bottom: 3px;
    }

    .button_lg {
        position: relative;
        display: block;
        padding: 10px 20px;
        color: #fff;
        background-color: #0f1923;
        overflow: hidden;
        box-shadow: inset 0px 0px 0px 1px transparent;
    }

    .button_lg::before {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 2px;
        height: 2px;
        background-color: #0f1923;
    }

    .button_lg::after {
        content: '';
        display: block;
        position: absolute;
        right: 0;
        bottom: 0;
        width: 4px;
        height: 4px;
        background-color: #0f1923;
        transition: all .2s ease;
    }

    .button_sl {
        display: block;
        position: absolute;
        top: 0;
        bottom: -1px;
        left: -8px;
        width: 0;
        background-color: #0400ffff;
        transform: skew(-15deg);
        transition: all .2s ease;
    }

    .button_text {
        position: relative;
    }

    .button:hover {
        color: #0f1923;
    }

    .button:hover .button_sl {
        width: calc(100% + 15px);
    }

    .button:hover .button_lg::after {
        background-color: #fff;
    }


    /* #jose-img {
        width: 280px;
        height: 150px;
        position: absolute;
        top: 56.8%;
        left: 286px;

        opacity: 0;
        visibility: hidden;
         transition: opacity 0.6s ease, visibility 0.8s ease;
    }

    .button:hover ~ #jose-img {
        opacity: 1;
        visibility: visible;
    } */
</style>