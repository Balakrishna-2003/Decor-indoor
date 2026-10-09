@echo off
setlocal enabledelayedexpansion
cd /d "%~dp0"

REM --- First pass: rename all .jpg to temporary unique names ---
set count=0
for /f "delims=" %%f in ('dir /b /a-d /on *.jpg') do (
    set /a count+=1
    set "num=00!count!"
    set "num=!num:~-2!"
    ren "%%f" "__tmp_!num!.jpg"
)

REM --- Second pass: rename temporary files to final sequential names ---
set count=0
for /f "delims=" %%f in ('dir /b /a-d /on __tmp_*.jpg') do (
    set /a count+=1
    set "num=00!count!"
    set "num=!num:~-2!"
    ren "%%f" "!num!.jpg"
)

echo Done. Renamed !count! files.
pause