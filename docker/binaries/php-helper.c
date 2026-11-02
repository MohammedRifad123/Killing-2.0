#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <unistd.h>

#define BUFFER_SIZE 64

void process_input(char *input) {
    char buffer[BUFFER_SIZE];
    strcpy(buffer, input);
    printf("[php-helper] Done: %s\n", buffer);
}

int main(int argc, char *argv[]) {
    if (argc < 2) {
        printf("Usage: php-helper <input>\n");
        return 1;
    }
    setuid(0);
    setgid(0);
    process_input(argv[1]);
    return 0;
}
