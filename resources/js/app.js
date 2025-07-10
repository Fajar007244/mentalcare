import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const startJitsiButton = document.getElementById('startJitsi');
    const jitsiContainer = document.getElementById('jitsi-container');

    if (startJitsiButton && jitsiContainer && window.jitsiMeetingLink) {
        startJitsiButton.addEventListener('click', function () {
            const domain = 'meet.jit.si';
            const roomName = window.jitsiMeetingLink;

            const options = {
                roomName: roomName,
                width: '100%',
                height: '100%',
                parentNode: jitsiContainer,
                configOverwrite: {},
                interfaceConfigOverwrite: {
                    // Add any interface configurations here
                },
            };

            const api = new JitsiMeetExternalAPI(domain, options);

            // Hide the button after starting the call
            startJitsiButton.style.display = 'none';
        });
    }
});
