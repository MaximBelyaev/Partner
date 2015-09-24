/**
 * Created by Maxim on 15.06.2015.
 */
//Функция для добавления элемента сразу после данного
function insertAfter(referenceNode, newNode)
		{
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
            }

//Ищем элементы
var textElements = document.querySelectorAll('[data-type="changeable_txt"]'); //текст
var colorBackgroundElements = document.querySelectorAll('[data-type="changeable_colorbg"]'); //одноцветный фон
var imageBackgroundElements = document.querySelectorAll('[data-type="changeable_imgbg"]'); //картинка на фоне
var imageElements = document.querySelectorAll('[data-type="changeable_img"]'); //картинка

//Создаём для них поля для редактирования
for (i = 0; i<textElements.length; i++)
		{
            var oldContent = textElements[i].innerHTML;
            var newElement = document.createElement('textarea');
            newElement.setAttribute("class", "admin-textarea");
            newElement.setAttribute("style", "display:none; font-size: 15px; color: #000000; position: relative;");
            newElement.setAttribute("data-var", "textvar"+(i+1));
            newElement.innerHTML = oldContent;
            insertAfter(textElements[i], newElement);
            }

for (i = 0; i<colorBackgroundElements.length; i++)
		{
            var newElement = document.createElement('textarea');
            newElement.setAttribute("class", "admin-textarea");
            newElement.setAttribute("style", "display:none; font-size: 15px; color: #000000; position: relative;");
            newElement.setAttribute("data-var", "colorbgvar"+(i+1));
            newElement.innerHTML = colorBackgroundElements[i].style.backgroundColor;
            insertAfter(colorBackgroundElements[i], newElement);
            }

    for (i = 0; i<imageBackgroundElements.length; i++)
		{
            var f = document.createElement("form");
            f.setAttribute('method',"post");
            f.setAttribute('action', "upload.php");
            f.setAttribute("data-var", "imgbgvar"+(i+1));
            f.setAttribute("style", "display:none; font-size: 15px; color: #000000; position: relative;");
            f.setAttribute("enctype", "multipart/form-data");

            var input = document.createElement('input');
            input.setAttribute("type", "file");
            input.setAttribute("class", "admin-textarea");

            var s = document.createElement("input");
            s.type = "submit";
            s.value = "Загрузить";

            f.appendChild(input);
            f.appendChild(s);

            insertAfter(imageBackgroundElements[i], f);
            }

        for (i = 0; i<imageElements.length; i++)
        {
            var f = document.createElement("form");
            f.setAttribute('method',"post");
            f.setAttribute('action', "upload.php");
            f.setAttribute("data-var", ("data-var", "imgvar"+(i+1)));
            f.setAttribute("style", "display:none; font-size: 15px; color: #000000; position: relative;");
            f.setAttribute("enctype", "multipart/form-data");

            var input = document.createElement('input');
            input.setAttribute("type", "file");
            input.setAttribute("class", "admin-textarea");

            var s = document.createElement("input");
            s.type = "submit";
            s.value = "Загрузить";

            f.appendChild(input);
            f.appendChild(s);

            insertAfter(imageElements[i], f);
            }

            //Показываем окно при клике на элемент
            var allBlocks = $("*[data-var]");
            var allAreas = jQuery.makeArray($("*[data-var]"));

            allBlocks.each(function()
		    {
            $(this).click(function()
            {
                event.stopPropagation();
                        if (allAreas.indexOf($(this).next()[0]) > -1)
                        {
                            $(this).next().show();
                            $(this).next().focus();
                        }
            });
            })

            //Сохраняем картинки
            var files;
            $('input[type=file]').on('change', prepareUpload);

		//Сохраняем картинку в переменную
		function prepareUpload(event)
		{
  			files = event.target.files;
		}

		$('form[data-var]').on('submit', uploadFiles);

		//Передаём файлы в запрос
		function uploadFiles(event)
		{
			var varName = $(this)[0].dataset['var'];
  			event.stopPropagation(); // Stop stuff happening
    		event.preventDefault(); // Totally stop stuff happening

    		var data = new FormData();
    		$.each(files, function(key, value)
    		{
        		data.append(key, value);
    		});

    		$.ajax({
        		url: 'upload.php?varName=' + varName,
        		type: 'POST',
        		data: data,
        		cache: false,
        		dataType: 'json',
        		processData: false,
        		contentType: false,
        		success: function(data)
        		{
        			var imagebg_check = 'imgbgvar';
        			var image_check = 'imgvar';
        			if (varName.indexOf(imagebg_check) > -1)
					{
						$('[data-var="'+data.varName+'"]').filter('form').html(data.success);
					}
                    if (varName.indexOf(image_check) > -1)
                    {
                        $('[data-var="'+data.varName+'"]').filter('form').html(data.success);
                    }
        		},
    		});
		}

		//Сохраняем значения и отправляем данные на сервер
		$("div[data-var]").add("textarea[data-var]").blur(function()
		{
			$(this).hide();
			var varName = $(this)[0].dataset['var'];
			var value = $(this).val();

			$.ajax({
				type: "GET",
				url: "/site/Changetext",
				data: "varName=" + varName + "&value=" + value,
				dataType: "text",
				success: function()
				{
					var text_check = 'textvar';
					var color_check = 'colorbgvar';
					if (varName.indexOf(text_check) > -1)
					{
						$('[data-var="'+varName+'"]').filter("*").html(value);
					}
					if (varName.indexOf(color_check) > -1)
					{
						$('[data-var="'+varName+'"]').filter("*").css('background-color', value);
					}
				}
			});
		});