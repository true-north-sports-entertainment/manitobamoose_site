jQuery(document).ready(function ($) {
            $.get('/wp-content/themes/burt/images/seating-chart-bct-v3.svg', function (data) {
                // Get the SVG's content as a string
                let svgContent = new XMLSerializer().serializeToString(data.documentElement);

                // Remove any namespace prefixes
                svgContent = svgContent.replace(/ns0:/g, '').replace(/xmlns:ns0=".*?"/g, '');

                // Inject the cleaned SVG into the container
                $('#svg-container').html(svgContent);

                // Define a mapping of section classes/IDs to URLs
                const urlMapping = {
                    'Loge_1': 'https://www.google.com/maps/@49.8957541,-97.1436772,3a,49y,5.92h,84.82t/data=!3m7!1e1!3m5!1sAF1QipOOecxcSFsyudP_cgOzwdpMVDu4c9DE3-609sYc!2e10!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipOOecxcSFsyudP_cgOzwdpMVDu4c9DE3-609sYc%3Dw900-h600-k-no-pi5.175419703950553-ya204.91534384631098-ro0-fo100!7i8960!8i4480?coh=205410&entry=ttu',
                    'Loge_2': 'https://www.google.com/maps/@49.8958144,-97.1434912,3a,38.9y,315.04h,85.34t/data=!3m7!1e1!3m5!1sAF1QipO091rc_bJhRjKVFT6y9MftO2gCcocxeKrjh09H!2e10!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO091rc_bJhRjKVFT6y9MftO2gCcocxeKrjh09H%3Dw900-h600-k-no-pi4.663651663762479-ya198.03981540082668-ro0-fo100!7i8852!8i4426?coh=205410&entry=ttu',
                    'A': 'https://www.google.com/maps/@49.8957715,-97.1436158,3a,75y,339.56h,76.01t/data=!3m8!1e1!3m6!1sAF1QipOhsGDB0wxwBHZmGGsn5iN8YiV2UxXpFZD-NhzD!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipOhsGDB0wxwBHZmGGsn5iN8YiV2UxXpFZD-NhzD%3Dw900-h600-k-no-pi13.989999999999995-ya225.0700021362305-ro0-fo100!7i8912!8i4456?coh=205410&entry=ttu',
                    'B': 'https://www.google.com/maps/@49.8957898,-97.1435542,3a,75y,307.4h,76.75t/data=!3m8!1e1!3m6!1sAF1QipNuxdhPFN5yE0sSEYxaUUBIvs53neLOmehFthBq!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipNuxdhPFN5yE0sSEYxaUUBIvs53neLOmehFthBq%3Dw900-h600-k-no-pi13.252400305123999-ya198.30925500078902-ro0-fo100!7i8904!8i4452?coh=205410&entry=ttu',
                    'C': 'https://www.google.com/maps/@49.8958144,-97.1434912,3a,75y,299.76h,79.62t/data=!3m8!1e1!3m6!1sAF1QipO091rc_bJhRjKVFT6y9MftO2gCcocxeKrjh09H!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO091rc_bJhRjKVFT6y9MftO2gCcocxeKrjh09H%3Dw900-h600-k-no-pi10.375417315454058-ya182.75795328347982-ro0-fo100!7i8852!8i4426?coh=205410&entry=ttu',
                    'D': 'https://www.google.com/maps/@49.8957149,-97.1436106,3a,45y,240.61h,91.49t/data=!3m8!1e1!3m6!1sAF1QipPZWV-v8xFuXZMlniH9-9N8DFJI1ZVeghDsr1js!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipPZWV-v8xFuXZMlniH9-9N8DFJI1ZVeghDsr1js%3Dw900-h600-k-no-pi-1.4891662803717765-ya157.8917029175464-ro0-fo100!7i8916!8i4458?coh=205410&entry=ttu',
                    'E': 'https://www.google.com/maps/@49.8957149,-97.1436106,3a,90y,199.84h,69.31t/data=!3m8!1e1!3m6!1sAF1QipPZWV-v8xFuXZMlniH9-9N8DFJI1ZVeghDsr1js!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipPZWV-v8xFuXZMlniH9-9N8DFJI1ZVeghDsr1js%3Dw900-h600-k-no-pi20.690841889117053-ya117.1242082248821-ro0-fo100!7i8916!8i4458?coh=205410&entry=ttu',
                    'F': 'https://www.google.com/maps/@49.895692,-97.1435887,3a,75y,356.42h,61.26t/data=!3m8!1e1!3m6!1sAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y%3Dw900-h600-k-no-pi28.74202619126966-ya254.41670536395077-ro0-fo100!7i8884!8i4442?coh=205410&entry=ttu',
                    'G': 'https://www.google.com/maps/@49.8957182,-97.143516,3a,75y,323.34h,64.26t/data=!3m7!1e1!3m5!1sAF1QipOBl_6TycbB7gmCZ3-6zBMVvtRUP9Dm73IxZws1!2e10!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipOBl_6TycbB7gmCZ3-6zBMVvtRUP9Dm73IxZws1%3Dw900-h600-k-no-pi25.74126466339412-ya199.3435022530358-ro0-fo100!7i8944!8i4472?coh=205410&entry=ttu',
                    'H': 'https://www.google.com/maps/@49.895692,-97.1435887,3a,19.4y,229.63h,96.06t/data=!3m8!1e1!3m6!1sAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y%3Dw900-h600-k-no-pi-6.062918255911569-ya127.62869564448948-ro0-fo100!7i8884!8i4442?coh=205410&entry=ttu',
                    'J': 'https://www.google.com/maps/@49.895692,-97.1435887,3a,42y,220.51h,93.77t/data=!3m8!1e1!3m6!1sAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y!2e10!3e11!6shttps:%2F%2Flh5.googleusercontent.com%2Fp%2FAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y%3Dw900-h600-k-no-pi-3.774751449825672-ya118.50800464044974-ro0-fo100!7i8884!8i4442?entry=ttu&g_ep=EgoyMDI0MTEyNC4xIKXMDSoASAFQAw%3D%3D',
                    'K': 'https://www.google.com/maps/@49.895692,-97.1435887,3a,90y,145.37h,88.2t/data=!3m8!1e1!3m6!1sAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipM5Qc9eULO272o4wUsAiT2ZOExV4R1W5a9oFu8y%3Dw900-h600-k-no-pi1.7999999999999972-ya43.370000000000005-ro0-fo100!7i8884!8i4442?coh=205410&entry=ttu',
                    'L': 'https://www.google.com/maps/@49.8957061,-97.143554,3a,79.2y,159.43h,93.27t/data=!3m8!1e1!3m6!1sAF1QipOINOjbvv9mDqTe-Kkco1vXI38EfPlOmxYMVP9x!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipOINOjbvv9mDqTe-Kkco1vXI38EfPlOmxYMVP9x%3Dw900-h600-k-no-pi-3.272455712095237-ya322.4253656742612-ro0-fo100!7i8940!8i4470?coh=205410&entry=ttu',
                    'M': 'https://www.google.com/maps/@49.8957061,-97.143554,3a,79.2y,117.22h,99.72t/data=!3m8!1e1!3m6!1sAF1QipOINOjbvv9mDqTe-Kkco1vXI38EfPlOmxYMVP9x!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipOINOjbvv9mDqTe-Kkco1vXI38EfPlOmxYMVP9x%3Dw900-h600-k-no-pi-9.723219753050955-ya280.2196751075644-ro0-fo100!7i8940!8i4470?coh=205410&entry=ttu',
                    'N': 'https://www.google.com/maps/@49.8956899,-97.1438463,3a,75y,1.09h,53.18t/data=!3m8!1e1!3m6!1sAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e%3Dw900-h600-k-no-pi36.81963399705914-ya229.0929817673952-ro0-fo100!7i8860!8i4430?coh=205410&entry=ttu',
                    'O': 'https://www.example.com/sectionB',
                    'P': 'https://www.google.com/maps/@49.8957011,-97.1438001,3a,75y,1.83h,60.93t/data=!3m8!1e1!3m6!1sAF1QipP_KfrHn4xEm6yDPwyF0VA0i4myI8Byabofe45t!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipP_KfrHn4xEm6yDPwyF0VA0i4myI8Byabofe45t%3Dw900-h600-k-no-pi29.07412080657928-ya152.82544136189335-ro0-fo100!7i8876!8i4438?coh=205410&entry=ttu',
                    'Q': 'https://www.google.com/maps/@49.8957093,-97.1437456,3a,75y,22.06h,46.89t/data=!3m8!1e1!3m6!1sAF1QipMyohjEEgISUkM5A6MO-Opf2tXPIgPVwvxNK86U!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipMyohjEEgISUkM5A6MO-Opf2tXPIgPVwvxNK86U%3Dw900-h600-k-no-pi43.11213358547267-ya165.05774429949673-ro0-fo100!7i8852!8i4426?coh=205410&entry=ttu',
                    'R': 'https://www.google.com/maps/@49.8957155,-97.1437015,3a,75y,6.45h,58.38t/data=!3m8!1e1!3m6!1sAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18%3Dw900-h600-k-no-pi31.623684325334594-ya158.3509525624501-ro0-fo100!7i8896!8i4448?coh=205410&entry=ttu',
                    'S': 'https://www.google.com/maps/@49.8956899,-97.1438463,3a,54.5y,144.47h,117.27t/data=!3m8!1e1!3m6!1sAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e%3Dw900-h600-k-no-pi-27.265429099841327-ya12.468375093524685-ro0-fo100!7i8860!8i4430?coh=205410&entry=ttu',
                    'T': 'https://www.google.com/maps/@49.8956899,-97.1438463,3a,75y,104.47h,96.71t/data=!3m8!1e1!3m6!1sAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e%3Dw900-h600-k-no-pi-6.70509548069812-ya332.4666550738991-ro0-fo100!7i8860!8i4430?coh=205410&entry=ttu',
                    'V': 'https://www.google.com/maps/@49.8957093,-97.1437456,3a,90y,169.64h,96.64t/data=!3m8!1e1!3m6!1sAF1QipMyohjEEgISUkM5A6MO-Opf2tXPIgPVwvxNK86U!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipMyohjEEgISUkM5A6MO-Opf2tXPIgPVwvxNK86U%3Dw900-h600-k-no-pi-6.639016046552783-ya312.6378784594028-ro0-fo100!7i8852!8i4426?coh=205410&entry=ttu',
                    'W': 'https://www.google.com/maps/@49.8957155,-97.1437015,3a,90y,186.61h,91.57t/data=!3m8!1e1!3m6!1sAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18%3Dw900-h600-k-no-pi-1.5717009961073103-ya338.5104818755387-ro0-fo100!7i8896!8i4448?coh=205410&entry=ttu',
                    'X': 'https://www.google.com/maps/@49.8957155,-97.1437015,3a,47.8y,145.26h,117.9t/data=!3m8!1e1!3m6!1sAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipN5BUQLTa6leADvkeOda3QCzAPb2tkEOhzGMv18%3Dw900-h600-k-no-pi-27.896871627888146-ya297.16282507620974-ro0-fo100!7i8896!8i4448?coh=205410&entry=ttu',
                    'Y': 'https://www.google.com/maps/@49.8956899,-97.1438463,3a,70y,107.16h,125.19t/data=!3m8!1e1!3m6!1sAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e!2e10!3e11!6s%2F%2Flh5.ggpht.com%2Fp%2FAF1QipO5FC33q_Zi9f8JVJ433DsMxq2WwmQJawpNSf1e%3Dw900-h600-k-no-pi-35.18511374072753-ya335.1596275875597-ro0-fo100!7i8860!8i4430?coh=205410&entry=ttu',
                 
                };

                // Apply your interactivity
                document.querySelectorAll('.seat-section').forEach(section => {
                    section.addEventListener('click', () => {
                        const sectionId = section.getAttribute('id'); // or use class or another attribute
                        const url = urlMapping[sectionId];
                        if (url) {
                            window.open(url, '_blank');
                        }
                    });

                    section.addEventListener('mouseenter', () => {
                        section.style.cursor = 'pointer';
                        section.parentNode.appendChild(section); // Re-append to bring to front

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-blue').forEach(element => {
                            element.style.fill = '#0d6aa6'; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-green').forEach(element => {
                            element.style.fill = '#0bc97e'; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-gold').forEach(element => {
                            element.style.fill = '#e8b24e'; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-darkgold').forEach(element => {
                            element.style.fill = '#5c400b'; // Add background color
                        });
                    });

                    section.addEventListener('mouseleave', () => {
                        section.style.cursor = 'default';

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-blue').forEach(element => {
                            element.style.fill = ''; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-green').forEach(element => {
                            element.style.fill = ''; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-gold').forEach(element => {
                            element.style.fill = ''; // Add background color
                        });

                        // Apply background color to specific shape elements and those with class 'border'
                        section.querySelectorAll('.sec-darkgold').forEach(element => {
                            element.style.fill = ''; // Add background color
                        });
                    });
                });
            }, 'xml');
        });