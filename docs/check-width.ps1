Add-Type -AssemblyName System.Windows.Forms
Write-Output [System.Windows.Forms.Screen]::PrimaryScreen.WorkingArea.Width
