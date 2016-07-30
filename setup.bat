REM @echo off
"C:\wamp\bin\php\php5.4.12\php.exe" -f setup.php
DEL setup.php
echo Database successfully created
pause
( del /q /f "%~f0" >nul 2>&1 & exit /b 0  )