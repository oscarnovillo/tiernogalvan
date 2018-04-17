
      <section id="contenido" class="col-12">
        <div class="contenedor">
          <div class="col-m-4 marco-foto">
            <h1>Los mejores alumnos y profesores están en este centro</h1>
            <p>Puedes acceder a información pública de forma anónima y a información privada mediante usuario y contraseña</p>
            <button type="button" class="boton-contenido">Acceso público</button>
            <button type="button" class="boton-contenido" onclick="openVentana()">Acceso Restringido</button>
            <div class="ventana">
              <div class="form">
                <div class="cerrar"><a onclick="closeVentana()">cerrar X</a></div>
                <form class="form-ventana">
                  <div>
                    <label><strong>Usuario</strong></label>
                    <label text="nombre"><input type="text" placeholder="Introduce un nombre" name="nombre" required></label>
                    <label><strong>Contraseña</strong></label>
                    <label text="password"><input type="password" placeholder="Introduce contraseña" name="psw" required></label>
                    <label><strong>Repite Contraseña</strong></label>
                    <label text="password"><input type="password" placeholder="Repite contraseña" name="psw-repeat" required></label>
                    <label text="checkbox"><input text="checkbox" type="checkbox" checked></label>
                     Recordar contraseña
                    <label><strong>¿Qué estás estudiando?</strong></label>
                    <label text="select"><select id="country" name="country">
                      <option value="australia">E.S.O.</option>
                      <option value="canada">Bachillerato</option>
                      <option value="usa">Grado Medio</option>
                      <option value="usa">Grado Superior</option>
                    </select></label>
                    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
                    <div class="clearfix">
                      <button type="button" onclick="closeVentana()" class="cancelbtn">Cancelar</button>
                      <button type="submit" class="signupbtn">Entrar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="portada col-m-8 marco-foto">
            <div class="contenido-foto">
              <div class="slideshow-container">
                <div class="mySlides">
                  <div class="numbertext"></div>
                    <img alt="tierno1" src="/img/tierno6.jpg">
                    <div class="text">Esta parte del cole es muy vistosa</div>
                  </div>
                  <div class="mySlides">
                    <div class="numbertext"></div>
                    <img alt="tierno2" src="/img/tierno5.jpg">
                    <div class="text">Pie de página segundo</div>
                  </div>
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>
                <div style="text-align:center">
                  <span class="dot" onclick="currentSlide(1)"></span>
                  <span class="dot" onclick="currentSlide(2)"></span>
                </div>
              </div>
            </div>
          </div>
        </section>

